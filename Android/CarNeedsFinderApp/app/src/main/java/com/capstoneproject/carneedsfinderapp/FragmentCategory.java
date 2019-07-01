package com.capstoneproject.carneedsfinderapp;

import android.app.Activity;
import android.content.Context;
import android.content.SharedPreferences;
import android.content.res.Resources;
import android.location.Address;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.CardView;
import android.util.Log;
import android.view.KeyEvent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.inputmethod.InputMethodManager;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.AutoCompleteTextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;


public class FragmentCategory extends Fragment {

    private FragmentActivity myContext;
    private OnFragmentInteractionListener mListener;
    private CardView gasStation, carAircon, autoMechanic, carWash, carAccessories, tireSupply;
    String dataAddress;


    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        final View view = inflater.inflate(R.layout.fragment_category, container, false);
        gasStation = view.findViewById(R.id.gasStation);
        carAircon = view.findViewById(R.id.carAircon);
        autoMechanic = view.findViewById(R.id.autoMechanic);
        carWash = view.findViewById(R.id.carWash);
        carAccessories = view.findViewById(R.id.carAccessories);
        tireSupply = view.findViewById(R.id.tireSupply);
        dataAddress = getString(R.string.address);





        gasStation.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shoptype", "%Gas Station%");
                SetFragment(new FragmentShopList(),"ShopList", bundle);
            }
        });

        carAircon.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shoptype", "%Car Aircon%");
                SetFragment(new FragmentShopList(),"ShopList", bundle);
            }
        });


        autoMechanic.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shoptype", "%Auto Mechanic%");
                SetFragment(new FragmentShopList(),"ShopList", bundle);
            }
        });

        carWash.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shoptype", "%Car Wash%");
                SetFragment(new FragmentShopList(),"ShopList", bundle);
            }
        });

        carAccessories.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shoptype", "%Car Accessories%");
                SetFragment(new FragmentShopList(),"ShopList", bundle);
            }
        });

        tireSupply.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Bundle bundle = new Bundle();
                bundle.putString("shoptype", "%Tire Supply%");
                SetFragment(new FragmentShopList(),"ShopList", bundle);
            }
        });

        return view;
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
    @Override
    public void onResume() {
        super.onResume();

        if(getView() == null){
            return;
        }

        getView().setFocusableInTouchMode(true);
        getView().requestFocus();
        getView().setOnKeyListener(new View.OnKeyListener() {
            @Override
            public boolean onKey(View v, int keyCode, KeyEvent event) {

                if (event.getAction() == KeyEvent.ACTION_UP && keyCode == KeyEvent.KEYCODE_BACK){
                    // handle back button's click listener
                    return true;
                }
                return false;
            }
        });
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
