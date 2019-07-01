package com.capstoneproject.carneedsfinderapp;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.RatingBar;
import android.widget.TextView;

import java.util.List;

public class ReviewListAdapter extends RecyclerView.Adapter<ReviewListAdapter.ViewHolder> {

    public static final String TAG = "PlaceListAdapter";
    Context mContext;
    private LayoutInflater mInflater;
    List<ReviewList> list;


    public ReviewListAdapter(Context ctx, List<ReviewList> list) {
        this.mContext = ctx;
        this.list = list;
        mInflater = (LayoutInflater) ctx
                .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public ReviewListAdapter.ViewHolder onCreateViewHolder(ViewGroup viewGroup, int i) {
        View view = mInflater.inflate(R.layout.review, viewGroup, false);
        final ViewHolder holder = new ViewHolder(view);

        return holder;
    }

    @Override
    public void onBindViewHolder(ReviewListAdapter.ViewHolder holder, int i) {
        ReviewList reviewList = list.get(i);

        holder.reviewAuthor.setText(reviewList.getReviewername_r());
        holder.reviewDate.setText(reviewList.getReviewdate_r());
        holder.reviewContent.setText(reviewList.getReview_r().replace("\n\n", " ").replace("\n", " "));
        holder.reviewRatingBar.setRating(Float.parseFloat(String.valueOf(reviewList.getRate_r())));


    }


    @Override
    public int getItemCount() {
        return list.size();
    }

    public static class ViewHolder extends RecyclerView.ViewHolder {
        TextView reviewAuthor,reviewDate,reviewContent ;
        RatingBar reviewRatingBar;

        public ViewHolder(View itemView) {
            super(itemView);


            reviewDate = (TextView) itemView.findViewById(R.id.review_date);
            reviewContent = (TextView) itemView.findViewById(R.id.review_content);
            reviewRatingBar = (RatingBar) itemView.findViewById(R.id.review_rating);
            reviewAuthor = (TextView) itemView.findViewById(R.id.review_author);


        }
    }
}
