package com.capstoneproject.carneedsfinderapp;

/**
 * Created by userIDN on 7/6/2018.
 */

import android.Manifest;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.location.Location;
import android.location.LocationManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.provider.Settings;
import android.support.annotation.NonNull;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.content.ContextCompat;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.RelativeLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.akexorcist.googledirection.DirectionCallback;
import com.akexorcist.googledirection.GoogleDirection;
import com.akexorcist.googledirection.constant.TransportMode;
import com.akexorcist.googledirection.model.Direction;
import com.akexorcist.googledirection.model.Info;
import com.akexorcist.googledirection.model.Leg;
import com.akexorcist.googledirection.model.Route;
import com.akexorcist.googledirection.model.Step;
import com.akexorcist.googledirection.util.DirectionConverter;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptor;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.Circle;
import com.google.android.gms.maps.model.CircleOptions;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MapStyleOptions;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;

import static android.content.ContentValues.TAG;
import static android.content.Context.MODE_PRIVATE;
import static android.support.v4.content.PermissionChecker.checkSelfPermission;

public class FragmentNearest extends Fragment implements OnMapReadyCallback {

    private GoogleMap mMap;
    private FragmentActivity myContext;
    private OnFragmentInteractionListener mListener;
    private Boolean mLocationPermissionsGranted = false;
    private FusedLocationProviderClient mFusedLocationProviderClient;
    double mylat,mylng,longitude,latitude;
    Location mLocation = null;
    Bundle bundle;
    private static final String FINE_LOCATION = Manifest.permission.ACCESS_FINE_LOCATION;
    private static final String COURSE_LOCATION = Manifest.permission.ACCESS_COARSE_LOCATION;
    private static final int LOCATION_PERMISSION_REQUEST_CODE = 1234;
    private Marker nearestmarker;
    private static final int CODE_GET_REQUEST = 1024;
    private static final int CODE_POST_REQUEST = 1025;
    Spinner spnCategory;
    String selectedCategory;
    List<String> category = new ArrayList<String>();
    private List<ShopList> shopData = new ArrayList<>();
    List<Marker> markerList = new ArrayList<Marker>();
    String dataAddress, myCategory;
    Snackbar unableToGet, permissionDenied;
    SharedPreferences prefs;
    int mapID, idMap;
    ImageView refresh;
    int prefmap;


    public static FragmentNearest newInstance() {
        FragmentNearest fragment = new FragmentNearest();
        return fragment;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_nearest, null, false);
        spnCategory = (Spinner)view.findViewById(R.id.spnCategory);
        refresh = (ImageView) view.findViewById(R.id.btnRefresh);
        dataAddress = getString(R.string.address);
        if (category != null) {
            category.clear();
        }
        category.add("Select a Category");
        category.add("Gas Station");
        category.add("Car Aircon");
        category.add("Auto Mechanic");
        category.add("Car Wash");
        category.add("Car Accessories");
        category.add("Tire Supply");

        if (mMap != null){
            mMap.clear();
        }



        ArrayAdapter<String> adapter = new ArrayAdapter<String>(getActivity(), R.layout.layout_spinner_item, category){
            @Override
            public boolean isEnabled(final int position){
                if(position == 0)
                {
                    // Disable the first item from Spinner
                    // First item will be use for hint
                    return false;
                }
                else
                {
                    return true;
                }
            }
            @Override
            public View getDropDownView(int position, View convertView,
                                        ViewGroup parent) {
                View view = super.getDropDownView(position, convertView, parent);
                TextView tv = (TextView) view;
                if(position == 0){
                    // Set the hint text color gray
                    tv.setTextColor(Color.GRAY);
                }
                else {
                    tv.setTextColor(Color.BLACK);
                }
                return view;
            }
        };

        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spnCategory.setAdapter(adapter);
        Toast.makeText(getContext(), "Choose category first to get the nearest shop!", Toast.LENGTH_LONG).show();

        getLocationPermission();


        return view;
    }



    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;


        prefs = getActivity().getSharedPreferences("mapstyle", MODE_PRIVATE);
        idMap = prefs.getInt("mapid", 1);//"No name defined" is the default value.
        if (idMap == 1) {
            mapID = getActivity().getResources().getIdentifier("standardmap", "raw", getContext().getPackageName());
        }else if (idMap == 2) {
            mapID = getActivity().getResources().getIdentifier("retromap", "raw", getContext().getPackageName());
        }else if (idMap == 3) {
            mapID = getActivity().getResources().getIdentifier("nightmap", "raw", getContext().getPackageName());
        }else if (idMap == 4) {
            mapID = getActivity().getResources().getIdentifier("darkmap", "raw", getContext().getPackageName());
        }else if (idMap == 5) {
            mapID = getActivity().getResources().getIdentifier("auberginemap", "raw", getContext().getPackageName());
        }
        try {
            // Customise the styling of the base map using a JONS object defined
            // in a raw resource file.
            boolean success = googleMap.setMapStyle(
                    MapStyleOptions.loadRawResourceStyle(
                            getActivity(), mapID));

            if (!success) {
                Log.e(TAG, "Style parsing failed.");
            }
        } catch (Resources.NotFoundException e) {
            Log.e(TAG, "Can't find style. Error: ", e);
        }

        if (mLocationPermissionsGranted) {

            getDeviceLocation();
            if (ActivityCompat.checkSelfPermission(myContext, Manifest.permission.ACCESS_FINE_LOCATION)
                    != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(myContext,
                    Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                return;
            }
            mMap.setMyLocationEnabled(true);
            mMap.getUiSettings().setMyLocationButtonEnabled(false);
        }

    }

    private void getDeviceLocation() {

        mFusedLocationProviderClient = LocationServices.getFusedLocationProviderClient(myContext);

        try {
            if (mLocationPermissionsGranted) {

                final Task location = mFusedLocationProviderClient.getLastLocation();
                location.addOnCompleteListener(new OnCompleteListener() {
                    @Override
                    public void onComplete(@NonNull Task task) {
                        if (task.isSuccessful() && task.getResult() != null) {
                            Log.d(TAG, "onComplete: found location!");

                            Location currentLocation = (Location) task.getResult();
                            mLocation = (Location) task.getResult();
                            mylat = currentLocation.getLatitude();
                            mylng = currentLocation.getLongitude();
                            Log.d("Asdadaad", String.valueOf(new LatLng(latitude, longitude)));
                            Circle circle = mMap.addCircle(new CircleOptions()
                                    .center(new LatLng(mylat, mylng))
                                    .radius(2000)
                                    .strokeColor(Color.parseColor("#3CCEAD"))
                                    .fillColor(Color.parseColor("#4Dd3fce9")));
                            mMap.addMarker(new MarkerOptions()
                                    .icon(BitmapDescriptorFactory.fromBitmap(resizeMapIcons("user",150,150)))
                                    .flat(false)
                                    .position(new LatLng(mylat, mylng)));

                            moveCamera(new LatLng(mylat, mylng), 14f);

                            refresh.setOnClickListener(new View.OnClickListener() {
                                @Override
                                public void onClick(View view) {
                                    refresh.setOnClickListener(new View.OnClickListener() {
                                        @Override
                                        public void onClick(View view) {
                                            mMap.clear();
                                            String category = spnCategory.getSelectedItem().toString();
                                            if (markerList != null) {
                                                mMap.clear();
                                                markerList.clear();
                                            }
                                            getLocationPermission();

                                            if (category != "Select a Category") {

                                                HashMap<String, String> params = new HashMap<>();
                                                params.put("latitude", String.valueOf(mylat));
                                                params.put("longitude", String.valueOf(mylng));
                                                params.put("shoptype", "%" + category + "%");

                                                GetNearest request = new GetNearest(dataAddress + "/php/Db.php?dbqueries=getnearestbyshop", params, CODE_POST_REQUEST);
                                                request.execute();
                                            }


                                        }
                                    });
                                }
                            });


                            spnCategory.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                                @Override
                                public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                                    String selectedItemText = (String) parent.getItemAtPosition(position);
                                    selectedCategory = spnCategory.getSelectedItem().toString();
                                    if (position > 0) {
                                        // Notify the selected item text
                                        Toast.makeText
                                                (getContext(), "Selected : " + selectedItemText, Toast.LENGTH_SHORT)
                                                .show();
                                    }
                                    if (markerList != null) {
                                        mMap.clear();
                                        markerList.clear();
                                    }

                                    getLocationPermission();
                                    HashMap<String, String> params = new HashMap<>();
                                    params.put("latitude", String.valueOf(mylat));
                                    params.put("longitude", String.valueOf(mylng));
                                    params.put("shoptype", "%" + selectedCategory + "%");

                                    GetNearest request = new GetNearest(dataAddress + "/php/Db.php?dbqueries=getnearestbyshop", params, CODE_POST_REQUEST);
                                    request.execute();
                                }

                                public void onNothingSelected(AdapterView<?> adapterView) {
                                    return;
                                }
                            });

                        } else {
                            Log.d(TAG, "onComplete: current location is null");
                            unableToGet = Snackbar
                                    .make(getView(), "Unable to get current location", Snackbar.LENGTH_INDEFINITE).setAction("Retry", new View.OnClickListener() {
                                        @Override
                                        public void onClick(View view) {
                                            getLocationPermission();

                                        }
                                    });
                            unableToGet.show();
                        }
                    }
                });
            }
        } catch (SecurityException e) {
            Log.e(TAG, "getDeviceLocation: SecurityException: " + e.getMessage());
        }
    }


    private void moveCamera(LatLng latLng, float zoom){
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(latLng, zoom));

    }

    private void initMap(){
        Log.d(TAG, "initMap: initializing map");
        SupportMapFragment mapFragment = (SupportMapFragment) this.getChildFragmentManager()
                .findFragmentById(R.id.map);

        mapFragment.getMapAsync(this);
    }

    private void getLocationPermission() {
        Log.d(TAG, "getLocationPermission: getting location permissions");
        String[] permissions = {android.Manifest.permission.ACCESS_FINE_LOCATION,
                Manifest.permission.ACCESS_COARSE_LOCATION};

        LocationManager lm = (LocationManager)getContext().getSystemService(Context.LOCATION_SERVICE);
        boolean gps_enabled = false;
        boolean network_enabled = false;

        try {
            gps_enabled = lm.isProviderEnabled(LocationManager.GPS_PROVIDER);
        } catch(Exception ex) {}

        try {
            network_enabled = lm.isProviderEnabled(LocationManager.NETWORK_PROVIDER);
        } catch(Exception ex) {}

        if(!gps_enabled && !network_enabled) {
            // notify user

            AlertDialog.Builder dialog = new AlertDialog.Builder(getContext());
            dialog.setTitle("Location");
            dialog.setMessage(getString(R.string.gpsmessage));
            dialog.setPositiveButton(getContext().getResources().getString(R.string.turnon), new DialogInterface.OnClickListener() {
                @Override
                public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                    // TODO Auto-generated method stub
                    Intent myIntent = new Intent( Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                    getContext().startActivity(myIntent);
                    //get gps
                }
            });
            dialog.setNegativeButton(getContext().getString(R.string.cancel), new DialogInterface.OnClickListener() {

                @Override
                public void onClick(DialogInterface paramDialogInterface, int paramInt) {
                    // TODO Auto-generated method stub

                }
            });
            dialog.show();
        }
        if(checkSelfPermission(getContext(),
                FINE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
            if (checkSelfPermission(getContext(),
                    COURSE_LOCATION) == PackageManager.PERMISSION_GRANTED) {
                mLocationPermissionsGranted = true;
                initMap();
            } else {
                requestPermissions(
                        permissions,
                        LOCATION_PERMISSION_REQUEST_CODE);
            }
        } else {
            requestPermissions(
                    permissions,
                    LOCATION_PERMISSION_REQUEST_CODE);
        }
    }

    @Override
    public void onRequestPermissionsResult(int requestCode, @NonNull String[] permissions, @NonNull int[] grantResults) {
        Log.d(TAG, "onRequestPermissionsResult: called.");
        mLocationPermissionsGranted = false;

        switch (requestCode) {
            case LOCATION_PERMISSION_REQUEST_CODE: {
                if (grantResults.length > 0) {
                    for (int i = 0; i < grantResults.length; i++) {
                        String permission = permissions[i];
                        if (grantResults[i] != PackageManager.PERMISSION_GRANTED) {
                            mLocationPermissionsGranted = false;
                            Log.d(TAG, "onRequestPermissionsResult: permission failed");
                            {
                                boolean showRationale = shouldShowRequestPermissionRationale(permission);
                                if (!showRationale) {
                                    AlertDialog.Builder builder = new AlertDialog.Builder(myContext);
                                    builder.setPositiveButton("Settings", new DialogInterface.OnClickListener() {

                                        @Override
                                        public void onClick(DialogInterface dialog, int which) {
                                            Intent myAppSettings = new Intent(Settings.ACTION_APPLICATION_DETAILS_SETTINGS, Uri.parse("package:" + getActivity().getPackageName()));
                                            startActivity(myAppSettings);
                                            dialog.dismiss();
                                        }
                                    });
                                    builder.setNegativeButton("Dismiss", new DialogInterface.OnClickListener() {

                                        @Override
                                        public void onClick(DialogInterface dialog, int which) {
                                            dialog.dismiss();
                                        }
                                    });

                                    builder.setTitle(getString(R.string.note));
                                    builder.setMessage(getString(R.string.neveraskagainmessage));

                                    AlertDialog alert = builder.create();
                                    alert.show();


                                } else {

                                    permissionDenied = Snackbar
                                            .make(getView(), "Permission Denied.", Snackbar.LENGTH_INDEFINITE).setAction("Info", new View.OnClickListener() {
                                                @Override
                                                public void onClick(View view) {
                                                    AlertDialog.Builder builder = new AlertDialog.Builder(myContext);

                                                    builder.setTitle("Note");
                                                    builder.setMessage("Allowing the permission will give the application access to your current location to show your route to the destination");

                                                    builder.setPositiveButton("Allow", new DialogInterface.OnClickListener() {

                                                        public void onClick(DialogInterface dialog, int which) {
                                                            getLocationPermission();
                                                        }
                                                    });

                                                    builder.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {

                                                        @Override
                                                        public void onClick(DialogInterface dialog, int which) {
                                                            dialog.dismiss();
                                                        }
                                                    });

                                                    AlertDialog alert = builder.create();
                                                    alert.show();
                                                }
                                            });
                                    permissionDenied.show();
                                    return;
                                }
                            }

                        }
                    }
                    Log.d(TAG, "onRequestPermissionsResult: permission granted");
                    mLocationPermissionsGranted = true;
                    //initialize our map
                    Snackbar snackbar = Snackbar
                            .make(getView(), "Permission Granted.", Snackbar.LENGTH_LONG).setAction("Info", new View.OnClickListener() {
                                @Override
                                public void onClick(View view) {
                                    AlertDialog.Builder builder = new AlertDialog.Builder(myContext);

                                    builder.setTitle("Note");
                                    builder.setMessage("Allowing the permission will give the application access to your current location to show your route to the destination");

                                    builder.setPositiveButton("Okay", new DialogInterface.OnClickListener() {

                                        public void onClick(DialogInterface dialog, int which) {
                                            dialog.dismiss();
                                        }
                                    });
                                    AlertDialog alert = builder.create();
                                    alert.show();
                                }
                            });
                    snackbar.show();
                    initMap();
                }
            }
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
    }

    private class GetNearest extends AsyncTask<Void, Void, String> {
        String url;
        HashMap<String, String> params;
        int requestCode;

        GetNearest(String url, HashMap<String, String> params, int requestCode) {
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
                    Toast.makeText(myContext, object.getString("message"), Toast.LENGTH_SHORT).show();
                    shopData.clear();
                    JSONArray shops = object.getJSONArray("nearest");
                    for(int i=0; i < shops.length(); i++) {
                        final JSONObject shop = shops.getJSONObject(i);


                        createMarker(Double.parseDouble(shop.getString("latitude")),
                                Double.parseDouble(shop.getString("longitude")), shop.getString("idshop"),
                                selectedCategory);
                        moveCamera(new LatLng(mylat, mylng), 14f);

                        final ShopList shopList = new ShopList();

                        shopList.setShop_id(shop.getString("idshop"));
                        shopList.setShop_name(shop.getString("shopname"));
                        shopList.setShop_address(shop.getString("address"));
                        shopList.setShop_description(shop.getString("description"));
                        shopList.setShop_facebook(shop.getString("facebook"));
                        shopList.setShop_icon(shop.getString("shopicon"));
                        shopList.setShop_latitude(shop.getString("latitude"));
                        shopList.setShop_longitude(shop.getString("longitude"));
                        shopList.setShop_owner(shop.getString("owner_firstname") + " " + shop.getString("owner_lastname"));
                        shopList.setShop_phonenumber(shop.getString("phonenumber"));
                        shopList.setShop_telephonenumber(shop.getString("telephonenumber"));
                        shopList.setShop_type(shop.getString("shoptype"));
                        shopList.setShop_website(shop.getString("website"));
                        if(shop.getString("total_userrate")!="null") {
                            shopList.setTotal_userrate(shop.getString("total_userrate"));
                        }
                        if(shop.getString("total_rate")!="null"){
                            shopList.setShop_rating(shop.getDouble("total_rate"));
                        }


                        ArrayList<String> idhours = new ArrayList<>();
                        idhours.add(shop.getString("idHours"));
                        shopList.setIdHours(idhours);


                        ArrayList<String> opening = new ArrayList<>();
                        opening.add(shop.getString("opening"));
                        shopList.setOpening(opening);


                        ArrayList<String> closing = new ArrayList<>();
                        closing.add(shop.getString("closing"));
                        shopList.setClosing(closing);


                        ArrayList<String> day = new ArrayList<>();
                        day.add(shop.getString("day"));
                        shopList.setDay(day);

                        ArrayList<String> idslider = new ArrayList<>();
                        idslider.add(shop.getString("idslider"));
                        shopList.setIdslider(idslider);

                        ArrayList<String> slider = new ArrayList<>();
                        slider.add(shop.getString("slider"));
                        shopList.setSlider(slider);


                        shopData.add(shopList);




                        mMap.setOnMarkerClickListener(new GoogleMap.OnMarkerClickListener() {
                            @Override
                            public boolean onMarkerClick(final Marker arg0) {
                                arg0.hideInfoWindow();
                                // Create custom dialog object
                                final Dialog dialog = new Dialog(myContext);
                                // Include dialog.xml file
                                dialog.setContentView(R.layout.dialog);
                                // Set dialog title
                                dialog.setTitle("Custom Dialog");

                                for (int i = 0; i < shopData.size(); i++) {
                                    if (shopData.get(i).getShop_id().equals(arg0.getTitle())) {
                                        String shop_id = shopData.get(i).getShop_id();
                                        String shop_name = shopData.get(i).getShop_name();
                                        String shop_description = shopData.get(i).getShop_description();
                                        String shop_address = shopData.get(i).getShop_address();
                                        String shop_phonenumber = shopData.get(i).getShop_phonenumber();
                                        String shop_website = shopData.get(i).getShop_website();
                                        String shop_icon = shopData.get(i).getShop_icon();
                                        final String shoplatitude = shopData.get(i).getShop_latitude();
                                        final String shoplongitude = shopData.get(i).getShop_longitude();
                                        String owner = shopData.get(i).getShop_owner();
                                        String telephonenumber = shopData.get(i).getShop_telephonenumber();
                                        String facebook = shopData.get(i).getShop_facebook();
                                        String type = shopData.get(i).getShop_type();
                                        String typeshop = shopData.get(i).getType_shop();
                                        String total_userrate = shopData.get(i).getTotal_userrate();
                                        Double shop_rate = shopData.get(i).getShop_rating();

                                        TextView shopName = (TextView) dialog.findViewById(R.id.shop_name);
                                        shopName.setText(shop_name);
                                        TextView totaluserrate = (TextView) dialog.findViewById(R.id.totaluser);
                                        totaluserrate.setText(total_userrate);
                                        RatingBar rating = (RatingBar) dialog.findViewById(R.id.rating);
                                        if(shop_rate!=null){
                                            rating.setRating(Float.parseFloat(String.valueOf(shop_rate)));
                                        }
                                        TextView shopAddress = (TextView) dialog.findViewById(R.id.shop_address);
                                        shopAddress.setText(shop_address);
                                        ImageView image = (ImageView) dialog.findViewById(R.id.shop_pic);
                                        Picasso.with(myContext).load(dataAddress + "/uploads/" + shop_icon).fit().into(image);
                                        ImageButton btnCall = (ImageButton) dialog.findViewById(R.id.btnCall);
                                        if (!shop_phonenumber.isEmpty()) {
                                            btnCall.setOnClickListener(new View.OnClickListener() {
                                                @Override
                                                public void onClick(View view) {
                                                    Intent intent = new Intent(Intent.ACTION_DIAL);

                                                    intent.setData(Uri.parse("tel:" + shopList.getShop_phonenumber()));

                                                    getActivity().startActivity(intent);
                                                }
                                            });
                                        }else {
                                            btnCall.setVisibility(View.INVISIBLE);
                                        }

                                        Button ViewMapbtn = (Button) dialog.findViewById(R.id.btnMap);
                                        Button ViewShopbtn = (Button) dialog.findViewById(R.id.btnView);
                                        ViewShopbtn.setOnClickListener(new View.OnClickListener() {
                                            @Override
                                            public void onClick(View view) {
                                                ViewShop(arg0.getTitle());
                                                dialog.cancel();
                                            }
                                        });

                                        ViewMapbtn.setOnClickListener(new View.OnClickListener() {
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
                                                            Uri.parse("http://maps.google.com/maps?daddr="+ shoplatitude+","+ shoplongitude));
                                                    if (isAppInstalled("com.google.android.apps.maps")) {
                                                        intent.setClassName("com.google.android.apps.maps", "com.google.android.maps.MapsActivity");
                                                        if (appStatus == true) {
                                                            startActivity(intent);
                                                        }else {
                                                            Toast.makeText(getActivity(), R.string.gmnotavail,
                                                                    Toast.LENGTH_LONG).show();
                                                            GoDirection(arg0.getTitle());
                                                            dialog.cancel();
                                                        }
                                                    }else{
                                                        Toast.makeText(getActivity(), R.string.gmnotavail,
                                                                Toast.LENGTH_LONG).show();
                                                        GoDirection(arg0.getTitle());
                                                        dialog.cancel();

                                                    }

                                                }else {
                                                    GoDirection(arg0.getTitle());
                                                    dialog.cancel();

                                                }


                                            }
                                        });


                                    }
                                }

                                // set values for custom dialog components - text, image and button

                                if (arg0.getTitle() != null) {
                                    dialog.show();
                                    Window window = dialog.getWindow();
                                    window.setLayout(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
                                    arg0.hideInfoWindow();
                                    return true;
                                }else {
                                    return false;
                                }
                            }
                        });



                    }

                }else{
                    Toast.makeText(myContext, "No nearest shop of "+ selectedCategory, Toast.LENGTH_SHORT).show();
                    if (markerList != null) {
                        mMap.clear();
                        markerList.clear();
                    }
                    moveCamera(new LatLng(mylat, mylng), 14f);
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

    private void ViewShop (String shopid){
        for (int i = 0; i < shopData.size(); i++) {
            if (shopData.get(i).getShop_id().equals(shopid)) {
                String shop_id = shopData.get(i).getShop_id();
                String shop_name = shopData.get(i).getShop_name();
                String shop_description = shopData.get(i).getShop_description();
                String shop_address = shopData.get(i).getShop_address();
                String shop_phonenumber = shopData.get(i).getShop_phonenumber();
                String shop_website = shopData.get(i).getShop_website();
                String shop_icon = shopData.get(i).getShop_icon();
                String latitude = shopData.get(i).getShop_latitude();
                String longitude = shopData.get(i).getShop_longitude();
                String owner = shopData.get(i).getShop_owner();
                String telephonenumber = shopData.get(i).getShop_telephonenumber();
                String facebook = shopData.get(i).getShop_facebook();
                String type = shopData.get(i).getShop_type();
                String typeshop = shopData.get(i).getType_shop();
                String total_userrate = null;
                if (shopData.get(i).getTotal_userrate() != null) {
                    total_userrate = shopData.get(i).getTotal_userrate();
                }
                Float shop_rate = null;
                if (shopData.get(i).getShop_rating() != null) {
                    shop_rate = Float.parseFloat(String.valueOf(shopData.get(i).getShop_rating()));
                }


                ArrayList<String> idhours = new ArrayList<String>();
                String idhourss = String.valueOf(shopData.get(i).getIdHours());
                String[] idhoursss = idhourss.split(",");
                for (String item : idhoursss) {
                    idhours.add(item);
                }

                ArrayList<String> opening = new ArrayList<String>();
                String openings = String.valueOf(shopData.get(i).getOpening());
                String[] openingss = openings.split(",");
                for (String item : openingss) {
                    opening.add(item);
                }

                ArrayList<String> closing = new ArrayList<String>();
                String closings = String.valueOf(shopData.get(i).getClosing());
                String[] closingss = closings.split(",");
                for (String item : closingss) {
                    closing.add(item);
                }

                ArrayList<String> day = new ArrayList<String>();
                String days = String.valueOf(shopData.get(i).getDay());
                String[] dayss = days.split(",");
                for (String item : dayss) {
                    day.add(item);
                }

                ArrayList<String> idslider = new ArrayList<String>();
                String idsliders = String.valueOf(shopData.get(i).getIdslider());
                String[] idsliderss = idsliders.split(",");
                for (String item : idsliderss) {
                    idslider.add(item);
                }

                ArrayList<String> slider = new ArrayList<String>();
                String sliders = String.valueOf(shopData.get(i).getSlider());
                String[] sliderss = sliders.split(",");
                for (String item : sliderss) {
                    slider.add(item);
                }

                final Bundle bundle = new Bundle();
                bundle.putString("shop_id", shop_id);
                bundle.putString("shop_name", shop_name);
                bundle.putString("shop_description", shop_description);
                bundle.putString("shop_address", shop_address);
                bundle.putString("shop_phonenumber", shop_phonenumber);
                bundle.putString("shop_website", shop_website);
                bundle.putString("shop_icon", dataAddress + "/uploads/" + shop_icon);
                bundle.putString("latitude", latitude);
                bundle.putString("longitude", longitude);
                bundle.putString("owner", owner);
                bundle.putString("telephonenumber", telephonenumber);
                bundle.putString("facebook", facebook);
                bundle.putString("type", type);
                bundle.putString("typeshop", typeshop);
                bundle.putStringArrayList("idslider", idslider);
                bundle.putStringArrayList("slider", slider);
                bundle.putStringArrayList("idhours", idhours);
                bundle.putStringArrayList("opening", opening);
                bundle.putStringArrayList("closing", closing);
                bundle.putStringArrayList("day", day);
                bundle.putFloat("shop_rate", shop_rate);
                bundle.putString("total_userrate", total_userrate);

                SetFragment(new FragmentShopDetail(), "ShopDetail", bundle);
            }
        }
    }

    private void GoDirection (String shopid){
        for (int i = 0; i < shopData.size(); i++) {
            if (shopData.get(i).getShop_id().equals(shopid)) {
                String shop_id = shopData.get(i).getShop_id();
                String shop_name = shopData.get(i).getShop_name();
                String shop_description = shopData.get(i).getShop_description();
                String shop_address = shopData.get(i).getShop_address();
                String shop_phonenumber = shopData.get(i).getShop_phonenumber();
                String shop_website = shopData.get(i).getShop_website();
                String shop_icon = shopData.get(i).getShop_icon();
                String latitude = shopData.get(i).getShop_latitude();
                String longitude = shopData.get(i).getShop_longitude();
                String owner = shopData.get(i).getShop_owner();
                String telephonenumber = shopData.get(i).getShop_telephonenumber();
                String facebook = shopData.get(i).getShop_facebook();
                String type = shopData.get(i).getShop_type();
                String typeshop = shopData.get(i).getType_shop();
                String total_userrate = null;
                if (shopData.get(i).getTotal_userrate() != null) {
                    total_userrate = shopData.get(i).getTotal_userrate();
                }
                Float shop_rate = null;
                if (shopData.get(i).getShop_rating() != null) {
                    shop_rate = Float.parseFloat(String.valueOf(shopData.get(i).getShop_rating()));
                }
                ArrayList<String> idhours = new ArrayList<String>();
                String idhourss = String.valueOf(shopData.get(i).getIdHours());
                String[] idhoursss = idhourss.split(",");
                for (String item : idhoursss) {
                    idhours.add(item);
                }

                ArrayList<String> opening = new ArrayList<String>();
                String openings = String.valueOf(shopData.get(i).getOpening());
                String[] openingss = openings.split(",");
                for (String item : openingss) {
                    opening.add(item);
                }

                ArrayList<String> closing = new ArrayList<String>();
                String closings = String.valueOf(shopData.get(i).getClosing());
                String[] closingss = closings.split(",");
                for (String item : closingss) {
                    closing.add(item);
                }

                ArrayList<String> day = new ArrayList<String>();
                String days = String.valueOf(shopData.get(i).getDay());
                String[] dayss = days.split(",");
                for (String item : dayss) {
                    day.add(item);
                }

                ArrayList<String> idslider = new ArrayList<String>();
                String idsliders = String.valueOf(shopData.get(i).getIdslider());
                String[] idsliderss = idsliders.split(",");
                for (String item : idsliderss) {
                    idslider.add(item);
                }

                ArrayList<String> slider = new ArrayList<String>();
                String sliders = String.valueOf(shopData.get(i).getSlider());
                String[] sliderss = sliders.split(",");
                for (String item : sliderss) {
                    slider.add(item);
                }

                final Bundle bundle = new Bundle();
                bundle.putString("shop_id", shop_id);
                bundle.putString("shop_name", shop_name);
                bundle.putString("shop_description", shop_description);
                bundle.putString("shop_address", shop_address);
                bundle.putString("shop_phonenumber", shop_phonenumber);
                bundle.putString("shop_website", shop_website);
                bundle.putString("shop_icon", dataAddress + "/uploads/" + shop_icon);
                bundle.putString("latitude", latitude);
                bundle.putString("longitude", longitude);
                bundle.putString("owner", owner);
                bundle.putString("telephonenumber", telephonenumber);
                bundle.putString("facebook", facebook);
                bundle.putString("type", type);
                bundle.putString("typeshop", typeshop);
                bundle.putStringArrayList("idslider", idslider);
                bundle.putStringArrayList("slider", slider);
                bundle.putStringArrayList("idhours", idhours);
                bundle.putStringArrayList("opening", opening);
                bundle.putStringArrayList("closing", closing);
                bundle.putStringArrayList("day", day);
                bundle.getFloat("shop_rate", shop_rate);
                bundle.putString("total_userrate", total_userrate);


                SetFragment(new FragmentMap(), "Map", bundle);
            }
        }
    }

    public Bitmap resizeMapIcons(String iconName, int width, int height){
        Bitmap imageBitmap = BitmapFactory.decodeResource(getResources(),getContext().getResources().getIdentifier(iconName, "drawable", getActivity().getPackageName()));
        Bitmap resizedBitmap = Bitmap.createScaledBitmap(imageBitmap, width, height, false);
        return resizedBitmap;
    }

    protected Marker createMarker(double latitude, double longitude, String title, String shoptype) {
        int height = 100;
        int width = 100;
        BitmapDescriptor icon = null;

        if(shoptype.equals("Car Wash")){
            icon = BitmapDescriptorFactory.fromBitmap(resizeMapIcons("carwash",150,150));
        }else if(shoptype.equals("Gas Station")){
            icon = BitmapDescriptorFactory.fromBitmap(resizeMapIcons("gasstation",150,150));
        }else if(shoptype.equals("Car Aircon")){
            icon = BitmapDescriptorFactory.fromBitmap(resizeMapIcons("caraircon",150,150));
        }else if(shoptype.equals("Auto Mechanic")){
            icon = BitmapDescriptorFactory.fromBitmap(resizeMapIcons("carmaintenance",150,150));
        }else if(shoptype.equals("Car Accessories")){
            icon = BitmapDescriptorFactory.fromBitmap(resizeMapIcons("caraccessories",150,150));
        }else if(shoptype.equals("Tire Supply")){
            icon = BitmapDescriptorFactory.fromBitmap(resizeMapIcons("cartire",150,150));
        }

        nearestmarker = mMap.addMarker(new MarkerOptions()
                .position(new LatLng(latitude, longitude))
                .anchor(0.5f, 0.5f)
                .title(title)
                .icon(icon));

        markerList.add(nearestmarker);
        nearestmarker.hideInfoWindow();



        return nearestmarker;
    }

    // Change frame
    public void SetFragment(Fragment fragment, String name, Bundle bundle) {

        FragmentManager fragmentManager = ((FragmentActivity)myContext).getSupportFragmentManager();
        FragmentTransaction fragmentTransaction =
                fragmentManager.beginTransaction();
        fragmentTransaction.replace(R.id.frmContainer, fragment, name);
        fragment.setArguments(bundle);
        fragmentTransaction.addToBackStack(name);
        fragmentTransaction.commit();
    }

    @Override
    public void onDestroy() {
        super.onDestroy();
        if ( unableToGet!=null && unableToGet.isShown() ){
            unableToGet.dismiss();
        }
        if ( permissionDenied!=null && permissionDenied.isShown() ){
            permissionDenied.dismiss();
        }
    }
}
