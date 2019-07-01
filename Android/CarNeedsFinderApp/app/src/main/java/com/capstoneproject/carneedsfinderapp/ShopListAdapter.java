package com.capstoneproject.carneedsfinderapp;

import android.app.AlertDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.ApplicationInfo;
import android.content.pm.PackageManager;
import android.net.Uri;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.view.menu.MenuView;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.request.RequestOptions;
import com.squareup.picasso.Picasso;
import com.bumptech.glide.Glide;

import java.util.ArrayList;
import java.util.List;
import java.util.Timer;
import java.util.TimerTask;

import static android.content.Context.MODE_PRIVATE;


public class ShopListAdapter extends RecyclerView.Adapter<ShopListAdapter.ViewHolder> {

    public static final String TAG = "PlaceListAdapter";
    Context mContext;
    private LayoutInflater mInflater;
    List<ShopList> list;
    String dataAddress, shop_latitude, shop_longitude;
    public View view;
    SharedPreferences prefs;
    int prefmap;


    public ShopListAdapter(Context ctx, List<ShopList> list) {
        this.mContext = ctx;
        this.list = list;
        mInflater = (LayoutInflater) ctx
                .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public ShopListAdapter.ViewHolder onCreateViewHolder(ViewGroup viewGroup, int i) {
        View view = mInflater.inflate(R.layout.recycle_view_item, viewGroup, false);
        final ViewHolder holder = new ViewHolder(view);
        dataAddress = mContext.getResources().getString(R.string.address);

        return holder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int i) {

        final ShopList shopList = list.get(i);

        String shop_id = list.get(holder.getAdapterPosition()).getShop_id();
        String shop_name = list.get(holder.getAdapterPosition()).getShop_name();
        String shop_description = list.get(holder.getAdapterPosition()).getShop_description();
        String shop_address = list.get(holder.getAdapterPosition()).getShop_address();
        String shop_phonenumber = list.get(holder.getAdapterPosition()).getShop_phonenumber();
        String shop_website = list.get(holder.getAdapterPosition()).getShop_website();
        String shop_icon = list.get(holder.getAdapterPosition()).getShop_icon();
        final String latitude = list.get(holder.getAdapterPosition()).getShop_latitude();
        final String longitude = list.get(holder.getAdapterPosition()).getShop_longitude();
        String owner = list.get(holder.getAdapterPosition()).getShop_owner();
        String telephonenumber = list.get(holder.getAdapterPosition()).getShop_telephonenumber();
        String facebook = list.get(holder.getAdapterPosition()).getShop_facebook();
        String type = list.get(holder.getAdapterPosition()).getShop_type();
        final String typeshop = list.get(holder.getAdapterPosition()).getType_shop();
        String total_userrate = null;
        if (list.get(holder.getAdapterPosition()).getTotal_userrate() != null) {
            total_userrate = list.get(holder.getAdapterPosition()).getTotal_userrate();
        }
        Float shop_rate = null;
        if (list.get(holder.getAdapterPosition()).getShop_rating() != null) {
            shop_rate = Float.parseFloat(String.valueOf(list.get(holder.getAdapterPosition()).getShop_rating()));
        }


        ArrayList<String> idslider = new ArrayList<String>();
        String idsliders = String.valueOf(list.get(holder.getAdapterPosition()).getIdslider());
        String[] idsliderss = idsliders.split(",");
        for (String item : idsliderss) {
            idslider.add(item);
        }

        ArrayList<String> slider = new ArrayList<String>();
        String sliders = String.valueOf(list.get(holder.getAdapterPosition()).getSlider());
        String[] sliderss = sliders.split(",");
        for (String item : sliderss) {
            slider.add(item);
        }

        ArrayList<String> idhours = new ArrayList<String>();
        String idhourss = String.valueOf(list.get(holder.getAdapterPosition()).getIdHours());
        String[] idhoursss = idhourss.split(",");
        for (String item : idhoursss) {
            idhours.add(item);
        }

        ArrayList<String> opening = new ArrayList<String>();
        String openings = String.valueOf(list.get(holder.getAdapterPosition()).getOpening());
        String[] openingss = openings.split(",");
        for (String item : openingss) {
            opening.add(item);
        }

        ArrayList<String> closing = new ArrayList<String>();
        String closings = String.valueOf(list.get(holder.getAdapterPosition()).getClosing());
        String[] closingss = closings.split(",");
        for (String item : closingss) {
            closing.add(item);
        }

        ArrayList<String> day = new ArrayList<String>();
        String days = String.valueOf(list.get(holder.getAdapterPosition()).getDay());
        String[] dayss = days.split(",");
        for (String item : dayss) {
            day.add(item);
        }


        holder.shop_id.setText(shopList.getShop_id());
        holder.shop_name.setText(shopList.getShop_name());
        holder.shop_address.setText(shopList.getShop_address());
        holder.totalUserRate.setText(shopList.getTotal_userrate());
        String phone = (shopList.getShop_phonenumber());
        if (!phone.isEmpty()) {
            holder.btnCall.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent intent = new Intent(Intent.ACTION_DIAL);

                    intent.setData(Uri.parse("tel:" + shopList.getShop_phonenumber()));

                    mContext.startActivity(intent);
                }
            });
        }else {
        holder.btnCall.setVisibility(View.INVISIBLE);
        }

        if (shopList.getShop_rating() != null) {
            holder.rating.setRating(Float.parseFloat(String.valueOf(shopList.getShop_rating())));
        }

        Glide.with(mContext)
                .load(dataAddress + "/uploads/" + shopList.getShop_icon())
                .apply(new RequestOptions().placeholder(R.color.black).error(R.color.blue).diskCacheStrategy(DiskCacheStrategy.NONE).skipMemoryCache(true).centerCrop())

                 // scale to fill the ImageView and crop any extra
                .into(holder.shop_pic);
        final Bundle bundle = new Bundle();
        bundle.putString("shop_id", shop_id);
        bundle.putString("shop_name", shop_name);
        bundle.putString("shop_description", shop_description);
        bundle.putString("shop_address", shop_address);
        bundle.putString("shop_phonenumber", shop_phonenumber);
        bundle.putString("shop_website", shop_website);
        bundle.putString("shop_icon", dataAddress + "/uploads/"+shop_icon);
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



        holder.btnMap.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new Timer().schedule(new TimerTask() {
                    @Override
                    public void run() {

                        ApplicationInfo ai =
                                null;
                        try {
                            ai = mContext.getPackageManager().getApplicationInfo("com.google.android.apps.maps",0);
                        } catch (PackageManager.NameNotFoundException e) {
                            e.printStackTrace();
                        }

                        prefs = mContext.getSharedPreferences("mapstyle", MODE_PRIVATE);
                        prefmap = prefs.getInt("prefmap", 1);

                        if (prefmap == 2){
                            boolean appStatus = ai.enabled;
                            Intent intent = new Intent(android.content.Intent.ACTION_VIEW,
                                    Uri.parse("http://maps.google.com/maps?daddr="+ latitude +","+ longitude));
                            if (isAppInstalled("com.google.android.apps.maps")) {
                                intent.setClassName("com.google.android.apps.maps", "com.google.android.maps.MapsActivity");
                                if (appStatus == true) {
                                    mContext.startActivity(intent);
                                }else {
                                    Toast.makeText(mContext, R.string.gmnotavail,
                                            Toast.LENGTH_LONG).show();
                                    SetFragment(new FragmentMap(),"Map", bundle);

                                }
                            }else{
                                Toast.makeText(mContext, R.string.gmnotavail,
                                        Toast.LENGTH_LONG).show();

                                SetFragment(new FragmentMap(),"Map", bundle);

                            }

                        }else {
                            SetFragment(new FragmentMap(),"Map", bundle);

                        }


                    }
                }, 800);
            }
        });


        holder.cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new Timer().schedule(new TimerTask() {
                    @Override
                    public void run() {
                        Log.d("azdadada",typeshop);
                        if (typeshop == "%Gas Station%"){

                            SetFragment(new FragmentGasStationDetail(), "Map", bundle);

                        }else {
                            SetFragment(new FragmentShopDetail(), "Map", bundle);

                        }
                    }
                }, 800);

            }
        });

    }


    private boolean isAppInstalled(String uri) {
        PackageManager pm = mContext.getPackageManager();
        boolean app_installed = false;
        try {
            pm.getPackageInfo(uri, PackageManager.GET_ACTIVITIES);
            app_installed = true;
        } catch (PackageManager.NameNotFoundException e) {
            app_installed = false;
        }
        return app_installed;
    }

    @Override
    public int getItemCount() {
        return list.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView shop_name, shop_address, shop_id, totalUserRate;
        ImageView shop_pic;
        Button btnMap, btnShop;
        CardView cardView;
        RatingBar rating;
        ImageButton btnCall;


        public ViewHolder(View itemView) {
            super(itemView);
            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    shop_address.setSelected(true);
                }
            });

            cardView = (CardView) itemView.findViewById(R.id.relCardview);
            shop_name = (TextView) itemView.findViewById(R.id.shop_name);
            shop_address = (TextView) itemView.findViewById(R.id.shop_address);
            totalUserRate = (TextView) itemView.findViewById(R.id.totaluser);
            shop_id = (TextView) itemView.findViewById(R.id.shop_id);
            shop_pic = (ImageView) itemView.findViewById(R.id.shop_pic);
            btnMap = (Button) itemView.findViewById(R.id.btnMap);
            rating = (RatingBar) itemView.findViewById(R.id.rating);
            btnCall = (ImageButton) itemView.findViewById(R.id.btnCall);



        }
    }

    // Change frame
    public void SetFragment(Fragment fragment, String name, Bundle bundle) {

        FragmentManager fragmentManager = ((FragmentActivity)mContext).getSupportFragmentManager();
        FragmentTransaction fragmentTransaction =
                fragmentManager.beginTransaction();
        fragmentTransaction.replace(R.id.frmContainer, fragment, name);
        fragment.setArguments(bundle);
        fragmentTransaction.addToBackStack(name);
        fragmentTransaction.commit();
    }

}




