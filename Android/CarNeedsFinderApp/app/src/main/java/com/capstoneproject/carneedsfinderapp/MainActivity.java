package com.capstoneproject.carneedsfinderapp;

import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.provider.Settings;
import android.support.annotation.NonNull;
import android.support.design.widget.NavigationView;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.SearchView;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.squareup.picasso.Picasso;

public class MainActivity extends AppCompatActivity implements
        FragmentCategory.OnFragmentInteractionListener,
        FragmentMap.OnFragmentInteractionListener,
        FragmentAbout.OnFragmentInteractionListener,
        FragmentShopList.OnFragmentInteractionListener,
        FragmentShopDetail.OnFragmentInteractionListener,
        FragmentNearest.OnFragmentInteractionListener,
        FragmentProductList.OnFragmentInteractionListener ,
        FragmentServiceList.OnFragmentInteractionListener {

    private DrawerLayout mDrawerLayout;
    String user_fname, user_email,user_image;
    int login_state;
    private static final int RC_SIGN_IN = 9001;
    SharedPreferences.Editor editor;


    private FirebaseAuth mAuth;
    // [END declare_auth]

    private GoogleSignInClient mGoogleSignInClient;


    // [START on_start_check_user]
    @Override
    public void onStart() {
        super.onStart();
        // Check if user is signed in (non-null) and update UI accordingly.
        FirebaseUser currentUser = mAuth.getCurrentUser();
    }




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);


        GoogleSignInOptions gso = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
                .requestIdToken(getString(R.string.default_web_client_id))
                .requestEmail()
                .build();
        // [END config_signin]

        mGoogleSignInClient = GoogleSignIn.getClient(this, gso);

        // [START initialize_auth]
        mAuth = FirebaseAuth.getInstance();


        if (getIntent().getExtras() != null) {
            user_fname = getIntent().getStringExtra("user_fname");
            user_email = getIntent().getStringExtra("user_email");
            user_image = getIntent().getStringExtra("user_image");
            login_state = getIntent().getIntExtra("login_state",0);
        }


        editor= getSharedPreferences("mapstyle", MODE_PRIVATE).edit();

        mDrawerLayout = findViewById(R.id.drawer_layout);
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);
        ActionBar actionbar = getSupportActionBar();
        actionbar.setDisplayHomeAsUpEnabled(true);
        actionbar.setHomeAsUpIndicator(R.drawable.ic_menu_24dp);


        NavigationView navigationView = findViewById(R.id.nav_view);
        navigationView.setItemIconTintList(null);
        View hView =  navigationView.getHeaderView(0);
        ImageView nav_image = (ImageView)hView.findViewById(R.id.ic_user);
        TextView nav_user = (TextView)hView.findViewById(R.id.txtUser);
        TextView nav_email = (TextView)hView.findViewById(R.id.txtEmail);

        if(user_fname != null){
            Glide.with(this).load(user_image).into(nav_image);
            nav_user.setText(user_fname);
            nav_email.setText(user_email);

        }else{
            nav_user.setText("Guest");
            nav_email.setText("guest");
            editor.clear().commit();
        }



        final Bundle bundle = new Bundle();
        navigationView.setNavigationItemSelectedListener(
                new NavigationView.OnNavigationItemSelectedListener() {
                    @Override
                    public boolean onNavigationItemSelected(MenuItem menuItem) {
                        // set item as selected to persist highlight
                        menuItem.setChecked(true);
                        // close drawer when item is tapped
                        mDrawerLayout.closeDrawers();

                        // Add code here to update the UI based on the item selected
                        // For example, swap UI fragments here
                        if(menuItem.getTitle().toString().equals("Logout")){
                            signOut();
                            getSharedPreferences("user", 0).edit().clear().commit();
                            Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                            startActivity(intent);
                        }else if (menuItem.getTitle().toString().equals("About")) {
                            Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse("https://www.carneedsfinder.com"));
                            startActivity(browserIntent);
                            SetFragment(new FragmentAbout(), "About", bundle);
                        }else if (menuItem.getTitle().toString().equals("Developers")){
                            Intent browserIntent = new Intent(Intent.ACTION_VIEW, Uri.parse("https://www.carneedsfinder.com/developers.html"));
                            startActivity(browserIntent);
                        }else if (menuItem.getTitle().toString().equals("Nearest Shop")){
                            bundle.putString("title", "Nearest Shop");
                            SetFragment(new FragmentNearest(), "Nearest Shop", bundle);
                        }else if (menuItem.getTitle().toString().equals("Category")){
                            bundle.putString("title", "Category");
                            SetFragment(new FragmentCategory(),"Category", bundle);

                        }else if (menuItem.getTitle().toString().equals("Settings")){

                            Intent myAppSettings = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS, Uri.parse("package:" + getPackageName()));
                            startActivity(myAppSettings);
                        }

                        return true;
                    }
                });
        bundle.putString("title", "Category");
        SetFragment(new FragmentCategory(),"Category", bundle);


    }


    @Override
    public void onBackPressed() {
        android.app.FragmentManager fm = getFragmentManager();
        if (fm.getBackStackEntryCount() > 0) {
            Log.i("MainActivity", "popping backstack");
            fm.popBackStack();
        } else {
            Log.i("MainActivity", "nothing on backstack, calling super");
            super.onBackPressed();
        }
    }



    // Change frame
    public void SetFragment(Fragment fragment, String name, Bundle bundle) {

        FragmentManager fragmentManager = getSupportFragmentManager();
        FragmentTransaction fragmentTransaction =
                fragmentManager.beginTransaction();
        fragmentTransaction.replace(R.id.frmContainer, fragment, name);
        fragment.setArguments(bundle);
        fragmentTransaction.addToBackStack(name);
        fragmentTransaction.commit();
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                mDrawerLayout.openDrawer(GravityCompat.START);
                return true;
        }


        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (user_fname != null) {
            if (id == R.id.standard) {
                editor.putInt("mapid", 1);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mapstyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.retro) {
                editor.putInt("mapid", 2);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mapstyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.night) {
                editor.putInt("mapid", 3);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mapstyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.dark) {
                editor.putInt("mapid", 4);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mapstyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.aubergine) {
                editor.putInt("mapid", 5);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mapstyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            }else if (id == R.id.black) {
                editor.putInt("routeid", 1);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.routestyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.green) {
                editor.putInt("routeid", 2);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.routestyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.yellow) {
                editor.putInt("routeid", 3);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.routestyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.red) {
                editor.putInt("routeid", 4);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.routestyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.blue) {
                editor.putInt("routeid", 5);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.routestyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            } else if (id == R.id.white) {
                editor.putInt("routeid", 6);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.routestyle) + item.getTitle() + getString(R.string.builtinmap), Toast.LENGTH_LONG).show();
                return true;
            }
            else if (id == R.id.defaultmap) {
                editor.putInt("prefmap", 1);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mymap) + item.getTitle(), Toast.LENGTH_LONG).show();
                return true;
            }
            else if (id == R.id.googlemap) {
                editor.putInt("prefmap", 2);
                editor.apply();
                Toast.makeText(MainActivity.this,
                        getString(R.string.mymap) + item.getTitle(), Toast.LENGTH_LONG).show();
                return true;
            }
        }else {

            Toast.makeText(MainActivity.this,
                    getString(R.string.login), Toast.LENGTH_SHORT).show();


        }

        return super.onOptionsItemSelected(item);
    }

    @Override
    public void onFragmentInteraction(Uri uri) {

    }
    private void signOut() {
        // Firebase sign out
        mAuth.signOut();
        // Google sign out
        mGoogleSignInClient.signOut().addOnCompleteListener(this,
                new OnCompleteListener<Void>() {
                    @Override
                    public void onComplete(@NonNull Task<Void> task) {

                    }
                });

    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);

        return true;
    }


}