package com.capstoneproject.carneedsfinderapp;

import android.content.Context;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v7.widget.DefaultItemAnimator;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Toast;

import com.google.android.gms.ads.AdRequest;
import com.google.android.gms.ads.AdView;
import com.google.android.gms.ads.MobileAds;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;


public class FragmentProductList extends Fragment {

    private FragmentActivity myContext;
    private OnFragmentInteractionListener mListener;
    private ProductListAdapter adapter;
    private RecyclerView.LayoutManager layoutManager;
    private static RecyclerView recyclerView;
    private List<ProductList> prodData = new ArrayList<>();
    private static final int CODE_GET_REQUEST = 1024;
    private static final int CODE_POST_REQUEST = 1025;
    String shopid;
    String dataAddress;
    private AdView mAdView;

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        View view = inflater.inflate(R.layout.fragment_product_list, container, false);

        recyclerView = (RecyclerView) view.findViewById(R.id.product_list) ;
        recyclerView.setHasFixedSize(true);
        layoutManager = new LinearLayoutManager(myContext.getApplicationContext());
        recyclerView.setLayoutManager(layoutManager);
        recyclerView.setItemAnimator(new DefaultItemAnimator());
        adapter = new ProductListAdapter(myContext, prodData);
        recyclerView.setAdapter(adapter);
        dataAddress = getString(R.string.address);
        MobileAds.initialize(myContext, getString(R.string.unitid));
        mAdView = view.findViewById(R.id.adView);
        AdRequest adRequest = new AdRequest.Builder().build();
        mAdView.loadAd(adRequest);

        Bundle bundle = this.getArguments();
        if (bundle != null) {
            shopid = bundle.getString("shopid");
        }

        HashMap<String, String> params = new HashMap<>();
        params.put("shopid", shopid);

        GetData request = new GetData(dataAddress + "/php/Db.php?dbqueries=getproduct", params, CODE_POST_REQUEST);
        request.execute();

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
                    JSONArray shops = object.getJSONArray("products");
                    prodData.clear();
                    for(int i=0; i < shops.length(); i++){
                        ProductList productList = new ProductList();
                        JSONObject shop = shops.getJSONObject(i);

                        productList.setProduct_id(shop.getString("idshopproduct"));
                        productList.setProduct_name(shop.getString("productname"));
                        productList.setProduct_description(shop.getString("description"));
                        productList.setProduct_icon(shop.getString("image"));
                        productList.setProduct_price(shop.getString("price"));

                        prodData.add(productList);
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

    @Override
    public void onDetach() {
        mListener = null;
        super.onDetach();

    }

    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }

}
