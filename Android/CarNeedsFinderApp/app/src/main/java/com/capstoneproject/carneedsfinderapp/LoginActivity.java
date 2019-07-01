package com.capstoneproject.carneedsfinderapp;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.NonNull;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.graphics.Palette;
import android.util.Log;
import android.view.KeyEvent;
import android.view.View;
import android.view.animation.Animation;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.google.android.gms.auth.api.signin.GoogleSignIn;
import com.google.android.gms.auth.api.signin.GoogleSignInAccount;
import com.google.android.gms.auth.api.signin.GoogleSignInClient;
import com.google.android.gms.auth.api.signin.GoogleSignInOptions;
import com.google.android.gms.common.SignInButton;
import com.google.android.gms.common.api.ApiException;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.firebase.auth.AuthCredential;
import com.google.firebase.auth.AuthResult;
import com.google.firebase.auth.FirebaseAuth;
import com.google.firebase.auth.FirebaseUser;
import com.google.firebase.auth.GoogleAuthProvider;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.HashMap;

/**
 * Created by userIDN on 7/6/2018.
 */

public class LoginActivity extends AppCompatActivity{

    Button btnLoginGuest;
    EditText txtEmail, txtPass;
    String dataAddress, user_fname,user_email,user_image;
    private static final int RC_SIGN_IN = 9001;
    private SignInButton btnGoogle;
    int login_state;
    RelativeLayout homeLogin;
    Context context;

    NetworkCheck networkCheck;

    private FirebaseAuth mAuth;
    // [END declare_auth]

    private GoogleSignInClient mGoogleSignInClient;


    // [START on_start_check_user]
    @Override
    public void onStart() {
        super.onStart();
        // Check if user is signed in (non-null) and update UI accordingly.
        FirebaseUser currentUser = mAuth.getCurrentUser();
        updateUI(currentUser);
    }



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        final View parentLayout = findViewById(android.R.id.content);

        networkCheck = new NetworkCheck(getApplicationContext());

        GoogleSignInOptions gso = new GoogleSignInOptions.Builder(GoogleSignInOptions.DEFAULT_SIGN_IN)
                .requestIdToken(getString(R.string.default_web_client_id))
                .requestEmail()
                .build();
        // [END config_signin]

        mGoogleSignInClient = GoogleSignIn.getClient(this, gso);

        // [START initialize_auth]
        mAuth = FirebaseAuth.getInstance();
        btnLoginGuest = (Button) findViewById(R.id.btnLoginGuest);
        dataAddress = getString(R.string.address);
        btnGoogle = (SignInButton) findViewById(R.id.sign_in_button);
        TextView textView = (TextView) btnGoogle.getChildAt(0);
        textView.setText("Sign in Google Account");
        homeLogin = (RelativeLayout) findViewById(R.id.homeLogin);


        new Handler().postDelayed(new Runnable() {
            @Override
            public void run() {
                Animation in = AnimationUtils.loadAnimation(getApplicationContext(), android.R.anim.slide_in_left);
                homeLogin.startAnimation(in);
                homeLogin.setVisibility(View.VISIBLE);
            }
        }, 3 * 1000);

        CustomLayout mCustomLayout = (CustomLayout)findViewById(R.id.activity_login);
        Picasso.with(this).load(R.drawable.loginbg).into(mCustomLayout);


        btnLoginGuest.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                boolean inConnected = networkCheck.isNetworkAvailable();
                if (!inConnected){
                    Snackbar.make(parentLayout, getString(R.string.nonet), Snackbar.LENGTH_SHORT).show();
                }else {

                    Toast.makeText(getApplicationContext(), getString(R.string.signinsuccesful), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                    startActivity(intent);
                }
            }
        });


        btnGoogle.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                boolean inConnected = networkCheck.isNetworkAvailable();
                if (!inConnected){
                    Snackbar.make(parentLayout, getString(R.string.nonet), Snackbar.LENGTH_SHORT).show();
                }else {

                    signIn();
                }

            }
        });





    }


    // [START auth_with_google]
    private void firebaseAuthWithGoogle(GoogleSignInAccount acct) {
        Log.d("getid", "firebaseAuthWithGoogle:" + acct.getId());

        AuthCredential credential = GoogleAuthProvider.getCredential(acct.getIdToken(), null);
        mAuth.signInWithCredential(credential)
                .addOnCompleteListener(this, new OnCompleteListener<AuthResult>() {
                    @Override
                    public void onComplete(@NonNull Task<AuthResult> task) {
                        if (task.isSuccessful()) {
                            // Sign in success, update UI with the signed-in user's information
                            Log.d("successful", "signInWithCredential:success");
                            FirebaseUser user = mAuth.getCurrentUser();
                            Toast.makeText(getApplicationContext(), getString(R.string.signinsuccesful), Toast.LENGTH_SHORT).show();
                            updateUI(user);
                        } else {
                            // If sign in fails, display a message to the user.
                            Log.w("failed", "signInWithCredential:failure", task.getException());
                            updateUI(null);
                        }

                    }
                });
    }
    // [END auth_with_google]

    // [START signin]
    private void signIn() {
        Intent signInIntent = mGoogleSignInClient.getSignInIntent();
        startActivityForResult(signInIntent, RC_SIGN_IN);
    }
    // [END signin]



    private void updateUI(FirebaseUser user) {
        if (user != null) {
            user_fname =  user.getDisplayName();
            user_email = user.getEmail();
            user_image = user.getPhotoUrl().toString();
            login_state = 1;


            Intent intent = new Intent(LoginActivity.this, MainActivity.class);
            intent.putExtra("user_fname",user_fname);
            intent.putExtra("user_email",user_email);
            intent.putExtra("user_image",user_image);
            intent.putExtra("login_state", login_state);

            startActivity(intent);


        }
    }



    private long lastPressedTime;
    private static final int PERIOD = 2000;

    @Override
    public boolean onKeyDown(int keyCode, KeyEvent event) {
        if (event.getKeyCode() == KeyEvent.KEYCODE_BACK) {
            switch (event.getAction()) {
                case KeyEvent.ACTION_DOWN:
                    if (event.getDownTime() - lastPressedTime < PERIOD) {
                        finish();
                    } else {
                        Toast.makeText(getApplicationContext(), "Press again to exit.",
                                Toast.LENGTH_SHORT).show();
                        lastPressedTime = event.getEventTime();
                    }
                    return true;
            }
        }
        return false;
    }



    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data){
        super.onActivityResult(requestCode, resultCode, data);
        // Result returned from launching the Intent from GoogleSignInApi.getSignInIntent(...);
        if (requestCode == RC_SIGN_IN) {
            Task<GoogleSignInAccount> task = GoogleSignIn.getSignedInAccountFromIntent(data);
            try {
                // Google Sign In was successful, authenticate with Firebase
                GoogleSignInAccount account = task.getResult(ApiException.class);
                firebaseAuthWithGoogle(account);
            } catch (ApiException e) {
                // Google Sign In failed, update UI appropriately
                Log.w("signinfailed", "Google sign in failed", e);
                Toast.makeText(getApplicationContext(), getString(R.string.signinfail), Toast.LENGTH_SHORT).show();
                // [START_EXCLUDE]
                updateUI(null);
                // [END_EXCLUDE]
            }
        }else{
            onActivityResult(requestCode, resultCode, data);
        }

    }

}
