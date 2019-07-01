package com.capstoneproject.carneedsfinderapp;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.List;


public class ServiceListAdapter extends RecyclerView.Adapter<ServiceListAdapter.ViewHolder> {

    public static final String TAG = "PlaceListAdapter";
    Context mContext;
    private LayoutInflater mInflater;
    List<ServiceList> list;


    public ServiceListAdapter(Context ctx, List<ServiceList> list) {
        this.mContext = ctx;
        this.list = list;
        mInflater = (LayoutInflater) ctx
                .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public ServiceListAdapter.ViewHolder onCreateViewHolder(ViewGroup viewGroup, int i) {
        View view = mInflater.inflate(R.layout.layout_services, viewGroup, false);
        final ViewHolder holder = new ViewHolder(view);

        return holder;
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int i) {
        ServiceList serviceList = list.get(i);

        holder.service_id.setText(serviceList.getService_id());
        holder.service_name.setText(serviceList.getService_name());
        holder.service_price.setText(serviceList.getService_price());

    }


    @Override
    public int getItemCount() {
        return list.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView service_id, service_name, service_price;

        public ViewHolder(View itemView) {
            super(itemView);

            service_id = (TextView) itemView.findViewById(R.id.service_id);
            service_name = (TextView) itemView.findViewById(R.id.service_name);
            service_price = (TextView) itemView.findViewById(R.id.service_price);

        }
    }

}




