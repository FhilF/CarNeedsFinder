package com.capstoneproject.carneedsfinderapp;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentTransaction;
import android.support.v4.content.ContextCompat;
import android.support.v4.widget.SwipeRefreshLayout;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.Toast;

import com.bumptech.glide.load.model.Model;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;


public class FragmentShopList extends Fragment {

    private FragmentActivity myContext;
    private OnFragmentInteractionListener mListener;
    private ShopListAdapter adapter,myadapter;
    private RecyclerView.LayoutManager layoutManager;
    private static RecyclerView recyclerView;
    private List<ShopList> shopData = new ArrayList<>();
    private static final int CODE_GET_REQUEST = 1024;
    private static final int CODE_POST_REQUEST = 1025;
    String shoptype;
    String dataAddress;
    ImageView categoryTitle;
    public static ArrayList<ShopList> array_sort;
    public static ArrayList<ShopList> movieNamesArrayList;
    private EditText etsearch;
    int textlength = 0;
    private SwipeRefreshLayout swipeContainer;
    List<ShopList> shopLists = new ArrayList<ShopList>();
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);


    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_shop_list, container, false);

        recyclerView = (RecyclerView) view.findViewById(R.id.shop_list) ;
        recyclerView.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(myContext.getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        adapter = new ShopListAdapter(myContext, shopData);
        recyclerView.setAdapter(adapter);
        dataAddress = getString(R.string.address);
        categoryTitle = (ImageView) view.findViewById(R.id.categoryTitle);

        swipeContainer = (SwipeRefreshLayout) view.findViewById(R.id.swipe_container);
        // Setup refresh listener which triggers new data loading
        swipeContainer.setOnRefreshListener(new SwipeRefreshLayout.OnRefreshListener() {
            @Override
            public void onRefresh() {
                new Handler().postDelayed(new Runnable() {
                    @Override
                    public void run() {
                        swipeContainer.setRefreshing(false);
                        HashMap<String, String> params = new HashMap<>();
                        params.put("shoptype", shoptype);

                        GetData request = new GetData(dataAddress + "/php/Db.php?dbqueries=getshop", params, CODE_POST_REQUEST);
                        request.execute();
                    }
                }, 2000);
            }
        });
        // Configure the refreshing colors
        swipeContainer.setColorSchemeResources(android.R.color.holo_blue_bright,
                android.R.color.holo_green_light,
                android.R.color.holo_orange_light,
                android.R.color.holo_red_light);



        etsearch = (EditText) view.findViewById(R.id.myedittext);
        array_sort = new ArrayList<>();

        Bundle bundle = this.getArguments();
        if (bundle != null) {
             shoptype = bundle.getString("shoptype");
        }

        etsearch.setOnFocusChangeListener(new View.OnFocusChangeListener() {
            @Override
            public void onFocusChange(View v, boolean hasFocus) {
                if (hasFocus) {
                    etsearch.addTextChangedListener(new TextWatcher() {


                        public void afterTextChanged(Editable s) {
                        }

                        public void beforeTextChanged(CharSequence s, int start, int count, int after) {
                        }

                        public void onTextChanged(CharSequence s, int start, int before, int count) {
                            textlength = etsearch.getText().length();
                            array_sort.clear();
                            for (int i = 0; i < shopData.size(); i++) {
                                if (textlength <= shopData.get(i).getShop_name().length() || textlength <= shopData.get(i).getShop_address().length()) {
                                    Log.d("ertyyy", shopData.get(i).getShop_name().toLowerCase().trim());
                                    if (shopData.get(i).getShop_name().toLowerCase().trim().contains(
                                            etsearch.getText().toString().toLowerCase().trim()) || shopData.get(i).getShop_address().toLowerCase().trim().contains(
                                            etsearch.getText().toString().toLowerCase().trim())) {
                                        array_sort.add(shopData.get(i));
                                    }
                                }
                            }
                            adapter = new ShopListAdapter(myContext, array_sort);
                            adapter.notifyDataSetChanged();
                            recyclerView.setAdapter(adapter);
                            recyclerView.setLayoutManager(new LinearLayoutManager(getContext(), LinearLayoutManager.VERTICAL, false));

                        }
                    });
                }
            }
        });



        HashMap<String, String> params = new HashMap<>();
        params.put("shoptype", shoptype);

        GetData request = new GetData(dataAddress + "/php/Db.php?dbqueries=getshop", params, CODE_POST_REQUEST);
        request.execute();

        if(shoptype == "%Car Wash%"){
            categoryTitle.setImageDrawable(getResources().getDrawable( R.drawable.carwashbanner));
        }else if(shoptype == "%Car Accessories%"){
            categoryTitle.setImageDrawable(getResources().getDrawable( R.drawable.caraccessoriesbanner));
        }else if(shoptype == "%Car Aircon%"){
            categoryTitle.setImageDrawable(getResources().getDrawable( R.drawable.carairconbanner));
        }else if(shoptype == "%Auto Mechanic%"){
            categoryTitle.setImageDrawable(getResources().getDrawable(  R.drawable.automechanicbanner));
        }else if(shoptype == "%Tire Supply%"){
            categoryTitle.setImageDrawable(getResources().getDrawable( R.drawable.tiresupplybanner));
        }else if(shoptype == "%Gas Station%"){
            categoryTitle.setImageDrawable(getResources().getDrawable( R.drawable.gasstationbanner));
        }


        return view;


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
                    JSONArray shops = object.getJSONArray("shops");
                    shopData.clear();
                    for(int i=0; i < shops.length(); i++){
                        ShopList shopList = new ShopList();
                        JSONObject shop = shops.getJSONObject(i);

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
                        shopList.setType_shop(shoptype);
                        if(shop.getString("total_userrate")!="null"){
                            shopList.setTotal_userrate(shop.getString("total_userrate"));
                            Log.d("fragmenttotalgetstring", shop.getString("total_userrate"));
                            Log.d("fragmenttotalgettotal", shopList.getTotal_userrate());
                        }
                        if(shop.getString("total_rate")!="null"){
                            shopList.setShop_rating(shop.getDouble("total_rate"));
                        }

                        ArrayList<String> idslider = new ArrayList<>();
                        idslider.add(shop.getString("idslider"));
                        shopList.setIdslider(idslider);

                        ArrayList<String> slider = new ArrayList<>();
                        slider.add(shop.getString("slider"));
                        shopList.setSlider(slider);

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


                        shopData.add(shopList);

                    }
                    adapter.notifyDataSetChanged();

                }else{
                    Toast.makeText(myContext, object.getString("message"), Toast.LENGTH_SHORT).show();
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

    public void clear() {
        shopData.clear();
        adapter.notifyDataSetChanged();
    }

    // Add a list of items -- change to type used
    public void addAll(List<ShopList> list) {
        shopData.addAll(list);
        adapter.notifyDataSetChanged();
    }


    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);

    }



    @Override
    public void onResume() {
        super.onResume();
        adapter.notifyDataSetChanged();
    }
}
