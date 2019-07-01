package com.capstoneproject.carneedsfinderapp;

import android.app.Dialog;
import android.content.Context;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentActivity;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.widget.CardView;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.bumptech.glide.load.engine.DiskCacheStrategy;
import com.bumptech.glide.request.RequestOptions;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;


public class ProductListAdapter extends RecyclerView.Adapter<ProductListAdapter.ViewHolder> {

    public static final String TAG = "PlaceListAdapter";
    Context mContext;
    private LayoutInflater mInflater;
    List<ProductList> list;
    String dataAddress;




    public ProductListAdapter(Context ctx, List<ProductList> list) {
        this.mContext = ctx;
        this.list = list;
        mInflater = (LayoutInflater) ctx
                .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public ProductListAdapter.ViewHolder onCreateViewHolder(ViewGroup viewGroup, int i) {
        View view = mInflater.inflate(R.layout.layout_product, viewGroup, false);
        final ViewHolder holder = new ViewHolder(view);
        dataAddress = mContext.getResources().getString(R.string.address);


        return holder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int i) {
        final ProductList productList = list.get(i);

        holder.prod_id.setText(productList.getProduct_id());
        holder.prod_name.setText(productList.getProduct_name());
        holder.prod_price.setText(productList.getProduct_price());


        Glide.with(mContext)
                .load(dataAddress + "/uploads/products/" + productList.getProduct_icon())
                .apply(new RequestOptions().placeholder(R.color.black).error(R.color.blue).diskCacheStrategy(DiskCacheStrategy.NONE).skipMemoryCache(true).centerCrop())

                // scale to fill the ImageView and crop any extra
                .into(holder.prod_pic);

        holder.cardView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                final Dialog dialog = new Dialog(mContext);
                // Include dialog.xml file
                dialog.setContentView(R.layout.dialog_product);
                // Set dialog title
                dialog.setTitle("Custom Dialog");

                TextView prodName = (TextView) dialog.findViewById(R.id.dprod_name);
                prodName.setText(productList.getProduct_name());
                TextView prodPrice = (TextView) dialog.findViewById(R.id.dprod_price);
                prodPrice.setText(productList.getProduct_price());
                TextView prodDesc = (TextView) dialog.findViewById(R.id.dprod_description);
                prodDesc.setText(productList.getProduct_description());
                ImageView prodImage = (ImageView) dialog.findViewById(R.id.dprod_pic);

                Glide.with(mContext)
                        .load(dataAddress + "/uploads/products/" + productList.getProduct_icon())
                        .apply(new RequestOptions().placeholder(R.color.black).error(R.color.blue).diskCacheStrategy(DiskCacheStrategy.NONE).skipMemoryCache(true).centerCrop())

                        // scale to fill the ImageView and crop any extra
                        .into(prodImage);



                Log.d("adsada", productList.getProduct_icon());
                dialog.show();
                Window window = dialog.getWindow();
                window.setLayout(ViewGroup.LayoutParams.MATCH_PARENT, ViewGroup.LayoutParams.WRAP_CONTENT);
            }
        });

    }


    @Override
    public int getItemCount() {
        return list.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView prod_id, prod_name, prod_description, prod_price;
        ImageView prod_pic;
        CardView cardView;

        public ViewHolder(View itemView) {
            super(itemView);

            prod_id = (TextView) itemView.findViewById(R.id.prod_id);
            prod_name = (TextView) itemView.findViewById(R.id.prod_name);
            prod_description = (TextView) itemView.findViewById(R.id.prod_description);
            prod_price = (TextView) itemView.findViewById(R.id.prod_price);
            prod_pic = (ImageView) itemView.findViewById(R.id.prod_pic);
            cardView = (CardView) itemView.findViewById(R.id.productCardView);

        }
    }

}




