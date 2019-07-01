package com.capstoneproject.carneedsfinderapp;

import android.animation.ObjectAnimator;
import android.animation.ValueAnimator;
import android.app.Dialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.graphics.drawable.Drawable;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.Nullable;
import android.support.design.widget.CollapsingToolbarLayout;
import android.support.design.widget.Snackbar;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.content.ContextCompat;
import android.support.v7.widget.AppCompatImageView;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.support.v7.widget.Toolbar;
import android.util.DisplayMetrics;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ProgressBar;
import android.widget.RatingBar;
import android.widget.RelativeLayout;
import android.widget.TableLayout;
import android.widget.TableRow;
import android.widget.TextView;
import android.widget.Toast;

import com.daimajia.slider.library.Animations.BaseAnimationInterface;
import com.daimajia.slider.library.Indicators.PagerIndicator;
import com.daimajia.slider.library.SliderLayout;
import com.daimajia.slider.library.SliderTypes.BaseSliderView;
import com.daimajia.slider.library.SliderTypes.TextSliderView;
import com.daimajia.slider.library.Transformers.AccordionTransformer;
import com.google.android.gms.ads.AdListener;
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.MobileAds;
import com.google.android.gms.common.api.Api;
import com.google.android.gms.maps.model.LatLng;
import com.nineoldandroids.view.ViewHelper;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.text.DateFormat;
import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Comparator;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

import static android.content.Context.MODE_PRIVATE;


public class FragmentShopDetail extends Fragment {

    private FragmentActivity myContext;
    private OnFragmentInteractionListener mListener;
    private String shop_name, shop_id, shop_address, shop_phonenumber, shop_telephonenumber, shop_description, shop_latitude, shop_longitude, shop_website, shop_facebook, shop_owner, shop_type, shop_icon, type_shop, total_userrate,shop_rate;
    private ArrayList<String> idslider, slider, idhours, opening, closing, day;
    private TextView txtShopName, tvAddress, txtDescription, txtPhoneNumber, txtWebsite, txtFacebook, txtTelephone, review_author,review_email , review_content, txtTotalUser, shopreviewtitle,btnreport, report_author, report_email, report_shop, report_content;
    String user_fname, user_email;
    int login_state;
    private Button addReviews, add, viewProduct, viewService, getDirection, cancelreview, report_button, report_cancel;
    LinearLayout llReview;
    RatingBar add_rating, rating;
    LinearLayout linearLayout;
    private static final int CODE_GET_REQUEST = 1024;
    private static final int CODE_POST_REQUEST = 1025;
    private LinearLayout mLinearLayout;
    private RelativeLayout relHours;
    String dataAddress;
    ProgressBar progressBar;
    private SliderLayout sliderShow;
    private List<ReviewList> reviewData = new ArrayList<>();
    private List<ReviewList> reviewTotal = new ArrayList<>();
    private ReviewListAdapter adapter;
    private RecyclerView.LayoutManager layoutManager;
    private static RecyclerView recyclerView;
    RelativeLayout noreview;
    private AdView mAdView;
    SharedPreferences prefs;
    int prefmap;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_shop_detail, container, false);
        recyclerView = (RecyclerView) view.findViewById(R.id.review_list) ;
        recyclerView.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(myContext.getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        adapter = new ReviewListAdapter(myContext, reviewData);
        recyclerView.setAdapter(adapter);
        dataAddress = getString(R.string.address);


        recyclerView.setHasFixedSize(true);

        MobileAds.initialize(myContext, getString(R.string.unitid));
        mAdView = view.findViewById(R.id.adView);
        AdRequest adRequest = new AdRequest.Builder().build();
        mAdView.loadAd(adRequest);

        Bundle bundle = this.getArguments();
        if (bundle != null) {
            shop_id = bundle.getString("shop_id");
            shop_name = bundle.getString("shop_name");
            shop_address = bundle.getString("shop_address");
            shop_phonenumber = bundle.getString("shop_phonenumber");
            shop_telephonenumber = bundle.getString("telephonenumber");
            shop_description = bundle.getString("shop_description");
            shop_latitude = bundle.getString("latitude");
            shop_longitude = bundle.getString("longitude");
            shop_website = bundle.getString("shop_website");
            shop_facebook = bundle.getString("facebook");
            shop_owner = bundle.getString("owner");
            shop_type = bundle.getString("type");
            shop_icon = bundle.getString("shop_icon");
            type_shop = bundle.getString("typeshop");
            idslider = bundle.getStringArrayList("idslider");
            slider = bundle.getStringArrayList("slider");
            idhours = bundle.getStringArrayList("idhours");
            opening = bundle.getStringArrayList("opening");
            closing = bundle.getStringArrayList("closing");
            day = bundle.getStringArrayList("day");

        }

        mAdView.setAdListener(new AdListener() {
            @Override
            public void onAdLoaded() {
                // Code to be executed when an ad finishes loading.
            }

            @Override
            public void onAdFailedToLoad(int errorCode) {
                // Code to be executed when an ad request fails.
            }

            @Override
            public void onAdOpened() {
                // Code to be executed when an ad opens an overlay that
                // covers the screen.
            }

            @Override
            public void onAdLeftApplication() {
                // Code to be executed when the user has left the app.
            }

            @Override
            public void onAdClosed() {
                // Code to be executed when when the user is about to return
                // to the app after tapping on an ad.
            }
        });

        HashMap<String, String> params = new HashMap<>();
        params.put("shopid", shop_id);

        GetData request = new GetData(dataAddress + "/php/Db.php?dbqueries=getshopreview", params, CODE_POST_REQUEST);
        request.execute();

        GetTotal requestTotal = new GetTotal(dataAddress + "/php/Db.php?dbqueries=getshoptotaluserandrate", params, CODE_POST_REQUEST);
        requestTotal.execute();





        if (myContext.getIntent().getExtras() != null) {
            user_fname = myContext.getIntent().getStringExtra("user_fname");
            user_email = myContext.getIntent().getStringExtra("user_email");
            login_state = myContext.getIntent().getIntExtra("login_state",0);

        }

        //Toolbar
        CollapsingToolbarLayout collapsingToolbarLayout = (CollapsingToolbarLayout) view.findViewById(R.id.collapsing_toolbar_layout);
        collapsingToolbarLayout.setTitle(shop_name);
        noreview = (RelativeLayout)view.findViewById(R.id.relnoreview);
        SliderLayout sliderShow = (SliderLayout) view.findViewById(R.id.slider);
        txtShopName = (TextView) view.findViewById(R.id.txtShop);
        tvAddress = (TextView) view.findViewById(R.id.address);
        txtDescription = (TextView) view.findViewById(R.id.description);
        txtPhoneNumber = (TextView) view.findViewById(R.id.txtPhoneNumber);
        txtWebsite = (TextView) view.findViewById(R.id.txtWebsite);
        txtFacebook = (TextView) view.findViewById(R.id.txtFacebook);
        txtTelephone = (TextView) view.findViewById(R.id.txtTelephoneNumber);
        txtShopName.setText(shop_name);
        tvAddress.setText(shop_address);
        txtWebsite.setText(shop_website);
        txtPhoneNumber.setText(shop_phonenumber);
        txtDescription.setText(shop_description);
        txtFacebook.setText(shop_facebook);
        txtTelephone.setText(shop_telephonenumber);
        addReviews = (Button) view.findViewById(R.id.addReviews);
        viewProduct = (Button) view.findViewById(R.id.viewProduct);
        viewService = (Button) view.findViewById(R.id.viewServices);
        mLinearLayout = (LinearLayout) view.findViewById(R.id.pagesContainer);
        TableLayout tlHours = (TableLayout) view.findViewById(R.id.tlHours);
        relHours = (RelativeLayout) view.findViewById(R.id.relHours);
        getDirection = (Button) view.findViewById(R.id.btnDirection);
        progressBar = (ProgressBar) view.findViewById(R.id.progressBar);
        btnreport = (TextView) view.findViewById(R.id.btnReport);
        txtTotalUser = (TextView) view.findViewById(R.id.totaluser);
        rating = (RatingBar) view.findViewById(R.id.rating);



        HashMap<String,String> file_maps = new HashMap<String, String>();
        file_maps.put("Shop",shop_icon);
        if(!idslider.toString().equals("[[null]]")){
            for(int i=0; i < idslider.size(); i++) {
                String sliders;
                String image = dataAddress + "/uploads/" + slider.get(i);

                if (idslider.size() == 1) {
                    String one;
                    one = slider.get(i).substring(1);
                    sliders = dataAddress + "/uploads/" + one.substring(0, one.length() - 1);

                } else {
                    if (i == 0) {
                        sliders =dataAddress + "/uploads/" + slider.get(i).substring(1);
                    } else if (i == idslider.size() - 1) {
                        sliders = image.substring(0, image.length() - 1);
                    } else {
                        sliders = image;
                    }
                }
                Log.e("slider",sliders);
                file_maps.put("Shop",shop_icon);
                file_maps.put(String.valueOf(i),sliders);

            }
        }else {
            file_maps.put("Shop",shop_icon);
        }
        Log.e("file_maps", String.valueOf(file_maps.size()));
        for(String name : file_maps.keySet()) {
            Log.e("file_maps_slider", String.valueOf(file_maps.get(name)));
        }


        sliderShow = (SliderLayout) view.findViewById(R.id.slider);
        for(String name : file_maps.keySet()) {
            TextSliderView textSliderView = new TextSliderView(myContext);
            // initialize a SliderLayout
            textSliderView
                    .description(shop_name)
                    .image(file_maps.get(name))
                    .setScaleType(BaseSliderView.ScaleType.Fit);

            sliderShow.addSlider(textSliderView);
            sliderShow.setCustomAnimation(new DescriptionAnimation());


        }
        int hSize = file_maps.size();
        if (hSize == 1){
            sliderShow.stopAutoCycle();
        }else {
            sliderShow.setPagerTransformer(false,new AccordionTransformer());
        }



        Handler handler = new Handler();
        handler.postDelayed(new Runnable() {

            @Override
            public void run() {
                progressBar.setVisibility(View.GONE);
            }

        }, 5000); // 5000ms delay

        viewProduct.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shopid", shop_id);
                SetFragment(new FragmentProductList(),"Products", bundle);
            }
        });

        getDirection.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {

                ApplicationInfo ai =
                        null;
                try {
                    ai = getActivity().getPackageManager().getApplicationInfo("com.google.android.apps.maps",0);
                } catch (PackageManager.NameNotFoundException e) {
                    e.printStackTrace();
                }

                prefs = getActivity().getSharedPreferences("mapstyle", MODE_PRIVATE);
                prefmap = prefs.getInt("prefmap", 1);

                if (prefmap == 2){
                    boolean appStatus = ai.enabled;
                    Intent intent = new Intent(android.content.Intent.ACTION_VIEW,
                            Uri.parse("http://maps.google.com/maps?daddr="+ shop_latitude +","+ shop_longitude));
                    if (isAppInstalled("com.google.android.apps.maps")) {
                        intent.setClassName("com.google.android.apps.maps", "com.google.android.maps.MapsActivity");
                        if (appStatus == true) {
                            startActivity(intent);
                        }else {
                            Toast.makeText(getActivity(), R.string.gmnotavail,
                                    Toast.LENGTH_LONG).show();
                            final Bundle bundle = new Bundle();
                            bundle.putString("shop_id", shop_id);
                            bundle.putString("shop_name", shop_name);
                            bundle.putString("shop_description", shop_description);
                            bundle.putString("shop_address", shop_address);
                            bundle.putString("shop_phonenumber", shop_phonenumber);
                            bundle.putString("shop_website", shop_website);
                            bundle.putString("shop_icon", shop_icon);
                            bundle.putString("latitude", shop_latitude);
                            bundle.putString("longitude", shop_longitude);
                            bundle.putString("owner", shop_owner);
                            bundle.putString("telephonenumber", shop_telephonenumber);
                            bundle.putString("facebook", shop_facebook);
                            bundle.putString("type", shop_type);
                            bundle.putString("typeshop", type_shop);
                            bundle.putStringArrayList("idslider", idslider);
                            bundle.putStringArrayList("slider", slider);
                            bundle.putStringArrayList("idhours", idhours);
                            bundle.putStringArrayList("opening", opening);
                            bundle.putStringArrayList("closing", closing);
                            bundle.putStringArrayList("day", day);
                            SetFragment(new FragmentMap(),"Map", bundle);


                        }
                    }else{
                        Toast.makeText(getActivity(), R.string.gmnotavail,
                                Toast.LENGTH_LONG).show();
                        final Bundle bundle = new Bundle();
                        bundle.putString("shop_id", shop_id);
                        bundle.putString("shop_name", shop_name);
                        bundle.putString("shop_description", shop_description);
                        bundle.putString("shop_address", shop_address);
                        bundle.putString("shop_phonenumber", shop_phonenumber);
                        bundle.putString("shop_website", shop_website);
                        bundle.putString("shop_icon", shop_icon);
                        bundle.putString("latitude", shop_latitude);
                        bundle.putString("longitude", shop_longitude);
                        bundle.putString("owner", shop_owner);
                        bundle.putString("telephonenumber", shop_telephonenumber);
                        bundle.putString("facebook", shop_facebook);
                        bundle.putString("type", shop_type);
                        bundle.putString("typeshop", type_shop);
                        bundle.putStringArrayList("idslider", idslider);
                        bundle.putStringArrayList("slider", slider);
                        bundle.putStringArrayList("idhours", idhours);
                        bundle.putStringArrayList("opening", opening);
                        bundle.putStringArrayList("closing", closing);
                        bundle.putStringArrayList("day", day);
                        SetFragment(new FragmentMap(),"Map", bundle);

                    }

                }else {
                    final Bundle bundle = new Bundle();
                    bundle.putString("shop_id", shop_id);
                    bundle.putString("shop_name", shop_name);
                    bundle.putString("shop_description", shop_description);
                    bundle.putString("shop_address", shop_address);
                    bundle.putString("shop_phonenumber", shop_phonenumber);
                    bundle.putString("shop_website", shop_website);
                    bundle.putString("shop_icon", shop_icon);
                    bundle.putString("latitude", shop_latitude);
                    bundle.putString("longitude", shop_longitude);
                    bundle.putString("owner", shop_owner);
                    bundle.putString("telephonenumber", shop_telephonenumber);
                    bundle.putString("facebook", shop_facebook);
                    bundle.putString("type", shop_type);
                    bundle.putString("typeshop", type_shop);
                    bundle.putStringArrayList("idslider", idslider);
                    bundle.putStringArrayList("slider", slider);
                    bundle.putStringArrayList("idhours", idhours);
                    bundle.putStringArrayList("opening", opening);
                    bundle.putStringArrayList("closing", closing);
                    bundle.putStringArrayList("day", day);
                    SetFragment(new FragmentMap(),"Map", bundle);

                }



            }
        });



        viewService.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shopid", shop_id);
                SetFragment(new FragmentServiceList(),"Services", bundle);
            }
        });




        if(String.valueOf(day)!="[]"){
            for(int i=0; i < day.size(); i++) {
                if(day.get(i).equals("[null]")){
                    relHours.setVisibility(View.GONE);
                }else{
                    relHours.setVisibility(View.VISIBLE);
                }
                TableRow row = new TableRow(getContext());
                TextView lblDay=new TextView(getContext());
                TextView lblOpen=new TextView(getContext());
                TextView lbldash=new TextView(getContext());
                TextView lblClose=new TextView(getContext());
                tlHours.setColumnStretchable(0, true);
                tlHours.setColumnStretchable(1, true);
                tlHours.setColumnStretchable(2, true);
                tlHours.setColumnStretchable(3, true);
                lblOpen.setTextColor(this.getResources().getColor(R.color.grey));
                lblDay.setTextColor(this.getResources().getColor(R.color.blueGreen));
                lblClose.setTextColor(this.getResources().getColor(R.color.grey));
                if (day.size() == 1) {
                    String days, open, close, finalopen, finalclose;
                    days = day.get(i).substring(1);
                    open = opening.get(i).substring(1);
                    close = closing.get(i).substring(1);
                    lblDay.setText(days.substring(0,days.length() - 1));
                    finalopen = getFormatedDateTime(open.substring(0, opening.get(i).length() - 1), "HH:mm:ss", "hh:mm a");
                    finalclose = getFormatedDateTime(close.substring(0, closing.get(i).length() - 1), "HH:mm:ss", "hh:mm a");
                    if(finalopen.equals("12:00 AM") && finalclose.equals("12:00 AM")){
                        lblOpen.setText(" 24 Hours");
                    }else{
                        lblOpen.setText(finalopen);
                        lblClose.setText(finalclose);
                    }

                }else{
                    String finalopen, finalclose;
                    if(i==0){
                        lblDay.setText(day.get(i).substring(1));
                        finalopen = getFormatedDateTime(opening.get(i).substring(1), "HH:mm:ss", "hh:mm a");
                        finalclose = getFormatedDateTime(closing.get(i).substring(1), "HH:mm:ss", "hh:mm a");
                        if(finalopen.equals("12:00 AM") && finalclose.equals("12:00 AM")){
                            lblOpen.setText(" 24 Hours");
                        }else{
                            lblOpen.setText(finalopen);
                            lblClose.setText(finalclose);
                        }
                    }else if(i==day.size()-1){
                        lblDay.setText(day.get(i).substring(0, day.get(i).length() - 1));
                        finalopen = getFormatedDateTime(opening.get(i).substring(0, opening.get(i).length() - 1), "HH:mm:ss", "hh:mm a");
                        finalclose = getFormatedDateTime(closing.get(i).substring(0, closing.get(i).length() - 1), "HH:mm:ss", "hh:mm a");
                        if(finalopen.equals("12:00 AM") && finalclose.equals("12:00 AM")){
                            lblOpen.setText(" 24 Hours");
                        }else{
                            lblOpen.setText(finalopen);
                            lblClose.setText(finalclose);
                        }
                    }else{
                        lblDay.setText(day.get(i));
                        finalopen = getFormatedDateTime(opening.get(i), "HH:mm:ss", "hh:mm a");
                        finalclose = getFormatedDateTime(closing.get(i), "HH:mm:ss", "hh:mm a");
                        if(finalopen.equals("12:00 AM") && finalclose.equals("12:00 AM")){
                            lblOpen.setText(" 24 Hours");
                        }else{
                            lblOpen.setText(finalopen);
                            lblClose.setText(finalclose);
                        }
                    }
                }
                lbldash.setText(" - ");
                row.addView(lblDay);
                row.addView(lblOpen);
                row.addView(lbldash);
                row.addView(lblClose);
                tlHours.addView(row);
            }
        }else{
            relHours.setVisibility(View.GONE);
        }


        if(login_state != 0){
            btnreport.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    final Dialog dialog = new Dialog(myContext);
                    // Include dialog.xml file
                    dialog.setContentView(R.layout.dialog_report);
                    // Set dialog title
                    dialog.setTitle("Custom Dialog");
                    report_author = (TextView) dialog.findViewById(R.id.report_author);
                    report_author.setText(user_fname);
                    report_email = (TextView) dialog.findViewById(R.id.report_email);
                    report_email.setText(user_email);
                    report_content = (TextView) dialog.findViewById(R.id.report_content);
                    report_button = (Button) dialog.findViewById(R.id.add_report);
                    report_shop = (TextView)dialog.findViewById(R.id.shopreporttitle) ;
                    report_shop.setText(shop_name);
                    report_cancel = (Button) dialog.findViewById(R.id.cancel_report) ;


                    dialog.show();
                    Window window = dialog.getWindow();
                    window.setLayout(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);

                    report_cancel.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {
                            dialog.cancel();
                        }
                    });

                    report_button.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {
                            String report = report_content.getText().toString().trim();
                            String reportername = report_author.getText().toString().trim();
                            String reporteremail = report_email.getText().toString().trim();


                            if (report != null && !report.isEmpty()) {
                                HashMap<String, String> params = new HashMap<>();
                                params.put("report", report);
                                params.put("reportername", reportername);
                                params.put("reporteremail", reporteremail);
                                params.put("shop_idshop", shop_id);

                                RequestAddReport request = new RequestAddReport(dataAddress + "/php/Db.php?dbqueries=addshopreport", params, CODE_POST_REQUEST);
                                dialog.cancel();
                                request.execute();
                            }else {

                                Toast.makeText(getActivity(), "Please tell us your problem with this shop",
                                        Toast.LENGTH_LONG).show();
                            }

                        }
                    });
                }
            });

            addReviews.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    final Dialog dialog = new Dialog(myContext);
                    // Include dialog.xml file
                    dialog.setContentView(R.layout.dialog_rating);
                    // Set dialog title
                    dialog.setTitle("Custom Dialog");
                    review_author = (TextView) dialog.findViewById(R.id.review_author);
                    review_author.setText(user_fname);
                    review_email = (TextView) dialog.findViewById(R.id.review_email) ;
                    review_email.setText(user_email);
                    review_content = (TextView) dialog.findViewById(R.id.review_content);
                    add_rating = (RatingBar) dialog.findViewById(R.id.add_rating);
                    add = (Button) dialog.findViewById(R.id.add);
                    shopreviewtitle = (TextView)dialog.findViewById(R.id.shopreviewtitle) ;
                    shopreviewtitle.setText(shop_name);
                    cancelreview = (Button) dialog.findViewById(R.id.cancel_rate) ;


                    dialog.show();
                    Window window = dialog.getWindow();
                    window.setLayout(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);

                    cancelreview.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {
                            dialog.cancel();
                        }
                    });

                    add.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View view) {
                            String review = review_content.getText().toString().trim();
                            int rate = (int) add_rating.getRating();
                            String reviewername = review_author.getText().toString().trim();
                            String revieweremail = review_email.getText().toString().trim();

                            if (rate != 0 && review != null && !review.isEmpty()) {
                                HashMap<String, String> params = new HashMap<>();
                                params.put("comment", review);
                                params.put("rate", String.valueOf(rate));
                                params.put("shop_idshop", shop_id);
                                params.put("reviewername", reviewername);
                                params.put("revieweremail", revieweremail);

                                RequestAddReview request = new RequestAddReview(dataAddress + "/php/Db.php?dbqueries=addreview", params, CODE_POST_REQUEST);
                                dialog.cancel();
                                request.execute();
                            }else{
                                Toast.makeText(getActivity(), "Please add a review and feedback",
                                        Toast.LENGTH_LONG).show();
                                Log.d("aaa","dsadad");

                            }
                        }
                    });
                }
            });
        }else{
            addReviews.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    Toast.makeText(getActivity(), getResources().getString(R.string.login),
                            Toast.LENGTH_LONG).show();
                }
            });

            btnreport.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {

                    Toast.makeText(getActivity(), getResources().getString(R.string.login),
                            Toast.LENGTH_LONG).show();
                }
            });
        }





        return view;
    }

    private boolean isAppInstalled(String uri) {
        PackageManager pm = getContext().getPackageManager();
        boolean app_installed = false;
        try {
            pm.getPackageInfo(uri, PackageManager.GET_ACTIVITIES);
            app_installed = true;
        } catch (PackageManager.NameNotFoundException e) {
            app_installed = false;
        }
        return app_installed;
    }

    private class GetData extends AsyncTask<Void, Void, String> {
        String url;
        HashMap<String, String> params;
        int requestCode;

        GetData(String url, HashMap<String, String> params, int requestCode) {
            this.url = url;
            this.params = params;
            this.requestCode = requestCode;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                JSONObject object = new JSONObject(s);
                if (!object.getBoolean("error")) {
                    JSONArray shops = object.getJSONArray("shopreviews");
                    reviewData.clear();
                    for(int i=0; i < shops.length(); i++){
                        ReviewList reviewList = new ReviewList();
                        JSONObject shopreview = shops.getJSONObject(i);

                        reviewList.setReviewername_r(shopreview.getString("reviewername"));

                        reviewList.setRevieweremail_r(shopreview.getString("revieweremail"));

                        reviewList.setReview_r(shopreview.getString("review"));

                        reviewList.setRate_r(shopreview.getString("rate"));

                        reviewList.setIdreview_r(shopreview.getString("idreview"));

                        reviewList.setReviewdate_r(shopreview.getString("reviewdate"));


                        reviewData.add(reviewList);

                    }

                    adapter.notifyDataSetChanged();
                    if (reviewData.size() > 4){

                        DisplayMetrics displaymetrics = new DisplayMetrics();
                        getActivity().getWindowManager().getDefaultDisplay().getMetrics(displaymetrics);

                        int a =  (displaymetrics.heightPixels*80)/100;

                        recyclerView.getLayoutParams().height =a;

                    }
                    if (noreview.getVisibility() == View.VISIBLE) {
                        noreview.setVisibility(View.GONE);
                    }
                    Log.d("yayaya", String.valueOf(reviewData.size()));
                }else{
                    noreview.setVisibility(View.VISIBLE);
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }




        @Override
        protected String doInBackground(Void... voids) {
            GetPostRequest requestHandler = new GetPostRequest();

            if (requestCode == CODE_POST_REQUEST)
                return requestHandler.sendPostRequest(url, params);


            if (requestCode == CODE_GET_REQUEST)
                return requestHandler.sendGetRequest(url);

            return null;
        }
    }


    private class GetTotal extends AsyncTask<Void, Void, String> {
        String url;
        HashMap<String, String> params;
        int requestCode;

        GetTotal(String url, HashMap<String, String> params, int requestCode) {
            this.url = url;
            this.params = params;
            this.requestCode = requestCode;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                JSONObject object = new JSONObject(s);
                if (!object.getBoolean("error")) {
                    JSONArray shops = object.getJSONArray("shoptotals");
                    reviewTotal.clear();
                    for(int i=0; i < shops.length(); i++){
                        ReviewList reviewList = new ReviewList();
                        JSONObject shopreview = shops.getJSONObject(i);

                        shop_rate = shopreview.getString("total_rate");
                        total_userrate = shopreview.getString("total_userrate");


                        txtTotalUser.setText(total_userrate);
                        if(shop_rate!="null"){
                            rating.setRating(Float.parseFloat(shop_rate));
                        }

                    }


                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }




        @Override
        protected String doInBackground(Void... voids) {
            GetPostRequest requestHandler = new GetPostRequest();

            if (requestCode == CODE_POST_REQUEST)
                return requestHandler.sendPostRequest(url, params);


            if (requestCode == CODE_GET_REQUEST)
                return requestHandler.sendGetRequest(url);

            return null;
        }
    }


    public class DescriptionAnimation implements BaseAnimationInterface {
        /**
         * When current item is going to leave, let's make the description layout disappear.
         */
        @Override
        public void onPrepareCurrentItemLeaveScreen(View current) {
            View descriptionLayout = current.findViewById(R.id.description_layout);
            if (descriptionLayout != null) {
                current.findViewById(R.id.description_layout).setVisibility(View.INVISIBLE);
            }
        }

        /**
         * When next item is coming to show, let's hide the description layout.
         */
        @Override
        public void onPrepareNextItemShowInScreen(View next) {
            View descriptionLayout = next.findViewById(R.id.description_layout);
            if (descriptionLayout != null) {
                next.findViewById(R.id.description_layout).setVisibility(View.INVISIBLE);
            }
        }

        @Override
        public void onCurrentItemDisappear(View current) {

        }

        /**
         * When next item is shown, let's make an animation to show the
         * description layout.
         */
        @Override
        public void onNextItemAppear(View next) {

            View descriptionLayout = next.findViewById(R.id.description_layout);
            if (descriptionLayout != null) {
                float layoutY = ViewHelper.getY(descriptionLayout);
                next.findViewById(R.id.description_layout).setVisibility(View.VISIBLE);
                ValueAnimator animator = ObjectAnimator.ofFloat(
                        descriptionLayout,"y",layoutY + descriptionLayout.getHeight(),
                        layoutY).setDuration(500);
                animator.start();
            }
        }
    }





    public static String getFormatedDateTime(String dateStr, String strReadFormat, String strWriteFormat) {

        String formattedDate = dateStr;

        DateFormat readFormat = new SimpleDateFormat(strReadFormat, Locale.getDefault());
        DateFormat writeFormat = new SimpleDateFormat(strWriteFormat, Locale.getDefault());

        Date date = null;

        try {
            date = readFormat.parse(dateStr);
        } catch (ParseException e) {
        }

        if (date != null) {
            formattedDate = writeFormat.format(date);
        }

        return formattedDate;
    }

    private class RequestAddReview extends AsyncTask<Void, Void, String> {
        String url;
        HashMap<String, String> params;
        int requestCode;

        RequestAddReview(String url, HashMap<String, String> params, int requestCode) {
            this.url = url;
            this.params = params;
            this.requestCode = requestCode;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                JSONObject object = new JSONObject(s);
                if (!object.getBoolean("error")) {
                    HashMap<String, String> params = new HashMap<>();
                    params.put("shopid", shop_id);

                    GetData request = new GetData(dataAddress + "/php/Db.php?dbqueries=getshopreview", params, CODE_POST_REQUEST);
                    request.execute();
                    GetTotal requestTotal = new GetTotal(dataAddress + "/php/Db.php?dbqueries=getshoptotaluserandrate", params, CODE_POST_REQUEST);
                    requestTotal.execute();
                    Snackbar snackbar = Snackbar
                            .make(getView(), object.getString("message"), Snackbar.LENGTH_LONG);
                    snackbar.show();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }

        @Override
        protected String doInBackground(Void... voids) {
            GetPostRequest requestHandler = new GetPostRequest();

            if (requestCode == CODE_POST_REQUEST)
                return requestHandler.sendPostRequest(url, params);


            if (requestCode == CODE_GET_REQUEST)
                return requestHandler.sendGetRequest(url);

            return null;
        }
    }





    private class RequestAddReport extends AsyncTask<Void, Void, String> {
        String url;
        HashMap<String, String> params;
        int requestCode;

        RequestAddReport(String url, HashMap<String, String> params, int requestCode) {
            this.url = url;
            this.params = params;
            this.requestCode = requestCode;
        }

        @Override
        protected void onPostExecute(String s) {
            super.onPostExecute(s);
            try {
                JSONObject object = new JSONObject(s);
                if (!object.getBoolean("error")) {
                    Snackbar snackbar = Snackbar
                            .make(getView(), object.getString("message"), Snackbar.LENGTH_LONG);
                    snackbar.show();
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
        }


        @Override
        protected String doInBackground(Void... voids) {
            GetPostRequest requestHandler = new GetPostRequest();

            if (requestCode == CODE_POST_REQUEST)
                return requestHandler.sendPostRequest(url, params);


            if (requestCode == CODE_GET_REQUEST)
                return requestHandler.sendGetRequest(url);

            return null;
        }
    }


    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        myContext=(FragmentActivity) context;
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        } else {
            throw new RuntimeException(context.toString()
                    + " must implement OnFragmentInteractionListener");
        }
    }

    @Override
    public void onDetach() {
        mListener = null;
        super.onDetach();

    }

    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }

    // Change frame
    public void SetFragment(Fragment fragment, String name, Bundle bundle) {

        FragmentManager fragmentManager = myContext.getSupportFragmentManager();
        FragmentTransaction fragmentTransaction =
                fragmentManager.beginTransaction();
        fragmentTransaction.replace(R.id.frmContainer, fragment, name);
        fragment.setArguments(bundle);
        fragmentTransaction.addToBackStack(name);
        fragmentTransaction.commit();
    }

}
