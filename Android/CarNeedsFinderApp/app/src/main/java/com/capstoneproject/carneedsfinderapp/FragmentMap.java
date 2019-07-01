package com.capstoneproject.carneedsfinderapp;

/**
 * Created by userIDN on 7/6/2018.
 */

import android.*;
import android.Manifest;
import android.app.AlertDialog;
import android.app.Dialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager;
import android.content.res.Resources;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.location.Address;
import android.location.Geocoder;
import android.location.Location;
import android.location.LocationManager;
import android.media.AudioManager;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.os.SystemClock;
import android.provider.Settings;
import android.speech.tts.TextToSpeech;
import android.support.annotation.NonNull;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.content.ContextCompat;
import android.text.Html;
import android.text.Spanned;
import android.text.TextUtils;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.Interpolator;
import android.view.animation.LinearInterpolator;
import android.widget.Button;
import android.widget.FrameLayout;
import android.widget.ImageView;
import android.widget.RelativeLayout;
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
import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.MobileAds;
import com.google.android.gms.location.FusedLocationProviderClient;
import com.google.android.gms.location.LocationServices;
import com.google.android.gms.maps.CameraUpdate;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.CameraPosition;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.LatLngBounds;
import com.google.android.gms.maps.model.MapStyleOptions;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.android.gms.maps.model.Polyline;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.IOException;
import java.io.InputStream;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

import android.Manifest;

import static android.content.ContentValues.TAG;
import static android.content.Context.MODE_PRIVATE;
import static android.support.v4.content.PermissionChecker.checkSelfPermission;

public class FragmentMap extends Fragment implements OnMapReadyCallback {

    private GoogleMap mMap;
    private FragmentActivity myContext;
    private OnFragmentInteractionListener mListener;
    private Boolean mLocationPermissionsGranted = false;
    private FusedLocationProviderClient mFusedLocationProviderClient;
    double latitude;
    double longitude;
    Double shop_latitude, shop_longitude;
    String address,serverKey, shopname;
    Location mLocation = null;
    Bundle bundle;
    private static final String FINE_LOCATION = Manifest.permission.ACCESS_FINE_LOCATION;
    private static final String COURSE_LOCATION = Manifest.permission.ACCESS_COARSE_LOCATION;
    private static final int LOCATION_PERMISSION_REQUEST_CODE = 1234;
    private static final float DEFAULT_ZOOM = 15f;
    RelativeLayout relGo;
    Button btnGo;
    TextView txtDistance, txtDuration,txtShopName,txtAddress;
    Polyline polyline;
    FloatingActionButton btnRefresh;
    private Marker mMarker, myMarker;
    ImageView refresh;
    private AdView mAdView;
    Snackbar unableToGet, permissionDenied, errorRoute;
    int mapID, idMap, idRoute, routeID;
    SharedPreferences prefs;
    FrameLayout frameRefresh;


    public static FragmentMap newInstance() {
        FragmentMap fragment = new FragmentMap();
        return fragment;
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        Context context;
        View view = inflater.inflate(R.layout.fragment_map, null, false);
        relGo = (RelativeLayout) view.findViewById(R.id.relGo);
        btnGo = (Button) view.findViewById(R.id.btnGo);
        txtDistance = (TextView) view.findViewById(R.id.txtDistance);
        txtDuration = (TextView) view.findViewById(R.id.txtDuration);
        txtShopName = (TextView) view.findViewById(R.id.txtShopName);
        txtAddress = (TextView) view.findViewById(R.id.txtAddress);
        serverKey = getString(R.string.google_maps_key);
        refresh = (ImageView) view.findViewById(R.id.btnRefresh);
        MobileAds.initialize(myContext, getString(R.string.unitid));
        mAdView = view.findViewById(R.id.adView);
        btnRefresh = (FloatingActionButton) view.findViewById(R.id.fab);
        frameRefresh = (FrameLayout) view.findViewById(R.id.frameRefresh);

        bundle = this.getArguments();
        getLocationPermission();





        return view;


    }



    @Override
    public void onMapReady(GoogleMap googleMap) {
        mMap = googleMap;

        prefs = getActivity().getSharedPreferences("mapstyle", MODE_PRIVATE);
        idRoute = prefs.getInt("routeid", 1);
        idMap = prefs.getInt("mapid", 1);//"No name defined" is the default value.

        if (idRoute == 1){
            routeID = Color.BLACK;
        }else if (idRoute == 2){
            routeID = Color.GREEN;
        }else if (idRoute == 3){
            routeID = Color.YELLOW;
        }else if (idRoute == 4){
            routeID = Color.RED;
        }else if (idRoute == 5){
            routeID = Color.BLUE;
        }else if (idRoute == 6){
            routeID = Color.WHITE;
        }

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

        Log.d("test", String.valueOf(idRoute));
        try {
            // Customise the styling of the base map using a JSON object defined
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
            if (checkSelfPermission(myContext, android.Manifest.permission.ACCESS_FINE_LOCATION)
                    != PackageManager.PERMISSION_GRANTED && checkSelfPermission(myContext,
                    android.Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                return;
            }
            mMap.setMyLocationEnabled(true);
            mMap.getUiSettings().setMyLocationButtonEnabled(false);
        }

    }


    private void getDeviceLocation() {
        mMap.clear();
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
                            latitude = currentLocation.getLatitude();
                            longitude = currentLocation.getLongitude();

                            HashMap<String, String> params = new HashMap<>();
                            params.put("latitude", String.valueOf(latitude));
                            params.put("longitude", String.valueOf(longitude));

                            if (bundle != null && bundle.containsKey("latitude") && bundle.containsKey("longitude")) {
                                shop_latitude = Double.parseDouble(bundle.getString("latitude"));
                                shop_longitude = Double.parseDouble(bundle.getString("longitude"));
                                address = bundle.getString("shop_address");
                                shopname = bundle.getString("shop_name");

                                geoLocatePlace(shop_latitude, shop_longitude, address);
                            }

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

    private void geoLocatePlace(Double shop_latitude, Double shop_longitude, final String address) {
        Log.d(TAG, "geoLocate: geolocating");
        final LatLng origin = new LatLng(latitude, longitude);
        final LatLng destination = new LatLng(shop_latitude, shop_longitude);

        LatLngBounds.Builder builder = new LatLngBounds.Builder();
        builder.include(origin);
        builder.include(destination);
        LatLngBounds bounds = builder.build();
        LatLng mycenter = bounds.getCenter();
        mMap.moveCamera(CameraUpdateFactory.newLatLngZoom(mycenter, 14));





        GoogleDirection.withServerKey(serverKey)
                .from(origin)
                .to(destination)
                .transportMode(TransportMode.DRIVING)
                .execute(new DirectionCallback() {
                    @Override
                    public void onDirectionSuccess(final Direction direction, String rawBody) {
                        mMap.addMarker(new MarkerOptions()
                                .icon(BitmapDescriptorFactory.fromBitmap(resizeMapIcons("user",150,150)))
                                .flat(false)
                                .position(origin));
                        mMap.addMarker(new MarkerOptions()
                                .icon(BitmapDescriptorFactory.fromBitmap(resizeMapIcons("destination",150,150)))
                                .flat(false)
                                .position(destination));

                        if (direction.getStatus().equals("ZERO_RESULTS")) {
                            errorRoute = Snackbar
                                    .make(getView(), "Error getting route. Please try again.", Snackbar.LENGTH_INDEFINITE).setAction("Retry", new View.OnClickListener() {
                                        @Override
                                        public void onClick(View view) {
                                            new Timer().schedule(new TimerTask() {
                                                @Override
                                                public void run() {
                                                    getLocationPermission();
                                                }
                                            }, 5000);


                                        }
                                    });
                            errorRoute.show();
                        } else {

                            for (int i = 0; i < direction.getRouteList().size(); i++) {
                                final int x = i;
                                Route route = direction.getRouteList().get(i);
                                final ArrayList<LatLng> directionPositionList = route.getLegList().get(0).getDirectionPoint();
                                polyline = mMap.addPolyline(DirectionConverter.createPolyline(myContext, directionPositionList, 5,routeID));
                                polyline.setClickable(true);
                                polyline.setTag(i);
                            }

                            Route route = direction.getRouteList().get(Integer.parseInt(polyline.getTag().toString()));
                            Leg leg = route.getLegList().get(0);
                            Info distanceInfo = leg.getDistance();
                            Info durationInfo = leg.getDuration();
                            String distance = distanceInfo.getText();
                            String duration = durationInfo.getText();

                            txtDistance.setText(distance);
                            txtDuration.setText(duration);
                            txtAddress.setText(address);
                            txtShopName.setText(shopname);

                            refresh.setOnClickListener(new View.OnClickListener() {
                                @Override
                                public void onClick(View view) {
                                    mMap.clear();
                                    getLocationPermission();

                                }
                            });


                            btnGo.setOnClickListener(new View.OnClickListener() {
                                @Override
                                public void onClick(View v) {

                                    relGo.setVisibility(View.GONE);
                                    frameRefresh.setVisibility(View.VISIBLE);
                                    Snackbar snackbar = Snackbar
                                            .make(getView(), "Be safe!", Snackbar.LENGTH_SHORT);
                                    snackbar.show();
                                    AdRequest adRequest = new AdRequest.Builder().build();
                                    mAdView.loadAd(adRequest);

                                    btnRefresh.setOnClickListener(new View.OnClickListener() {
                                        @Override
                                        public void onClick(View view) {
                                            getDeviceLocation();
                                            relGo.setVisibility(View.GONE);
                                        }
                                    });

                                    final Route route = direction.getRouteList().get(Integer.parseInt(polyline.getTag().toString()));
                                    final Leg leg = route.getLegList().get(0);
                                    final List<Step> step = leg.getStepList();

                                    for (int i = 0; i < step.size(); i++) {
                                        mMap.clear();
                                        mMap.addMarker(new MarkerOptions()
                                                .flat(false)
                                                .icon(BitmapDescriptorFactory.fromBitmap(resizeMapIcons("destination",150,150)))
                                                .position(destination));
                                        final ArrayList<LatLng> directionPositionList = route.getLegList().get(0).getDirectionPoint();
                                        mMap.addPolyline(DirectionConverter.createPolyline(myContext, directionPositionList, 5, routeID));
                                        CameraPosition position = CameraPosition.builder()
                                                .target(origin)
                                                .zoom(18)
                                                .bearing((float) getBearingBetweenTwoPoints1(origin, destination))
                                                .tilt(50)
                                                .build();
                                        mMap.animateCamera(CameraUpdateFactory.newCameraPosition(position));
                                        mMarker = mMap.addMarker(new MarkerOptions()
                                                .position(origin)
                                                .flat(false)
                                                .zIndex(19)
                                                .icon(BitmapDescriptorFactory.fromBitmap(resizeMapIcons("user",150,150))));


                                        mMap.setOnMyLocationChangeListener(new GoogleMap.OnMyLocationChangeListener() {
                                            @Override
                                            public void onMyLocationChange(final Location location) {
                                                //PlaceName current location marker
                                                LatLng latLng = new LatLng(location.getLatitude(), location.getLongitude());

                                                CameraPosition position = CameraPosition.builder()
                                                        .target(new LatLng(location.getLatitude(), location.getLongitude()))
                                                        .zoom(16)
                                                        .bearing((float) getBearingBetweenTwoPoints1(latLng, destination))
                                                        .tilt(50)
                                                        .build();
                                                mMap.animateCamera(CameraUpdateFactory.newCameraPosition(position));

                                            }

                                        });

                                    }
                                }
                            });
                        }


                    }

                    @Override
                    public void onDirectionFailure(Throwable t) {
                        // Do something here
                    }
                });

    }



    public Bitmap resizeMapIcons(String iconName, int width, int height){
        Bitmap imageBitmap = BitmapFactory.decodeResource(getResources(),getContext().getResources().getIdentifier(iconName, "drawable", getActivity().getPackageName()));
        Bitmap resizedBitmap = Bitmap.createScaledBitmap(imageBitmap, width, height, false);
        return resizedBitmap;
    }


    private void initMap() {
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
                Log.d("test", String.valueOf(grantResults.length));
                if (grantResults.length > 0) {
                    for (int i = 0; i < grantResults.length; i++) {
                        String permission = permissions[i];
                        if (grantResults[i] != PackageManager.PERMISSION_GRANTED) {
                            mLocationPermissionsGranted = false;
                            Log.d(TAG, "onRequestPermissionsResult: permission failed");
                            {
                                boolean showRationale = shouldShowRequestPermissionRationale(permission);
                                if (!showRationale) {
                                    Log.d("test", "test");
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

    private double getBearingBetweenTwoPoints1(LatLng latLng1, LatLng latLng2) {

        double lat1 = degreesToRadians(latLng1.latitude);
        double long1 = degreesToRadians(latLng1.longitude);
        double lat2 = degreesToRadians(latLng2.latitude);
        double long2 = degreesToRadians(latLng2.longitude);


        double dLon = (long2 - long1);


        double y = Math.sin(dLon) * Math.cos(lat2);
        double x = Math.cos(lat1) * Math.sin(lat2) - Math.sin(lat1)
                * Math.cos(lat2) * Math.cos(dLon);

        double radiansBearing = Math.atan2(y, x);


        return radiansToDegrees(radiansBearing);
    }

    private double degreesToRadians(double degrees) {
        return degrees * Math.PI / 180.0;
    }

    private double radiansToDegrees(double radians) {
        return radians * 180.0 / Math.PI;
    }



    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        myContext = (FragmentActivity) context;
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

    @Override
    public void onDestroy() {
        super.onDestroy();
        if ( unableToGet!=null && unableToGet.isShown() ){
            unableToGet.dismiss();
        }
        if ( permissionDenied!=null && permissionDenied.isShown() ){
            permissionDenied.dismiss();
        }
        if ( errorRoute!=null && errorRoute.isShown() ){
            errorRoute.dismiss();
        }

    }

    public interface OnFragmentInteractionListener {
    }

}
