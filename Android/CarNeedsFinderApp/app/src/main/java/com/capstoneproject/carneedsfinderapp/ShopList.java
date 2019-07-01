package com.capstoneproject.carneedsfinderapp;


import android.util.Log;

import java.util.ArrayList;

public class ShopList {

    private String shop_name, shop_id, shop_address, shop_phonenumber, shop_telephonenumber, shop_description, shop_latitude, shop_longitude, shop_website, shop_facebook, shop_owner, shop_type, shop_icon, type_shop, total_userrate;
    private ArrayList<String> idslider, slider, idHours, opening, closing, day;
    double shop_rating;
    public ShopList() {

    }

    public void setIdHours(ArrayList<String> idHours) {
        this.idHours = idHours;
    }

    public ArrayList<String> getIdHours() {
        return idHours;
    }

    public Double getShop_rating() {
        return shop_rating;
    }

    public void setShop_rating(Double shop_rating) {
        this.shop_rating = shop_rating;
    }

    public void setOpening(ArrayList<String> opening) {
        this.opening = opening;
    }

    public ArrayList<String> getOpening() {
        return opening;
    }

    public void setClosing(ArrayList<String> closing) {
        this.closing = closing;
    }

    public ArrayList<String> getClosing() {
        return closing;
    }

    public void setDay(ArrayList<String> day) {
        this.day = day;
    }

    public ArrayList<String> getDay() {
        return day;
    }


    public ArrayList<String> getIdslider() {
        return idslider;
    }

    public void setIdslider(ArrayList<String> idslider) {
        this.idslider = idslider;
    }

    public ArrayList<String> getSlider() {
        return slider;
    }

    public void setSlider(ArrayList<String> slider) {
        this.slider = slider;
    }

    public String getShop_name() {
        return shop_name;
    }

    public void setShop_name(String shop_name) {
        this.shop_name = shop_name;
    }

    public String getType_shop() {
        return type_shop;
    }

    public void setType_shop(String type_shop) {
        this.type_shop = type_shop;
    }

    public String getShop_id() {
        return shop_id;
    }

    public void setShop_id(String shop_id) {
        this.shop_id = shop_id;
    }

    public String getShop_address() {
        return shop_address;
    }

    public void setShop_address(String shop_address) {
        this.shop_address = shop_address;
    }
    public String getShop_phonenumber() {
        return shop_phonenumber;
    }

    public void setShop_phonenumber(String shop_phonenumber) {
        this.shop_phonenumber = shop_phonenumber;
    }
    public String getShop_telephonenumber() {
        return shop_telephonenumber;
    }

    public void setShop_telephonenumber(String shop_telephonenumber) {
        this.shop_telephonenumber = shop_telephonenumber;
    }

    public String getShop_description() {
        return shop_description;
    }

    public void setShop_description(String shop_description) {
        this.shop_description = shop_description;
    }

    public String getTotal_userrate() {
        return total_userrate;
    }

    public void setTotal_userrate(String total_userrate) {
        this.total_userrate = total_userrate;
    }

    public String getShop_latitude() {
        return shop_latitude;
    }

    public void setShop_latitude(String shop_latitude) {
        this.shop_latitude = shop_latitude;
    }

    public String getShop_longitude() {
        return shop_longitude;
    }

    public void setShop_longitude(String shop_longitude) {
        this.shop_longitude = shop_longitude;
    }

    public String getShop_website() {
        return shop_website;
    }

    public void setShop_website(String shop_website) {
        this.shop_website = shop_website;
    }
    public String getShop_facebook() {
        return shop_facebook;
    }

    public void setShop_facebook(String shop_facebook) {
        this.shop_facebook = shop_facebook;
    }

    public String getShop_owner() {
        return shop_owner;
    }

    public void setShop_owner(String shop_owner) {
        this.shop_owner = shop_owner;
    }

    public String getShop_type() {
        return shop_type;
    }

    public void setShop_type(String shop_type) {
        this.shop_type = shop_type;
    }

    public String getShop_icon() {
        return shop_icon;
    }

    public void setShop_icon(String shop_icon) {
        this.shop_icon = shop_icon;
    }


}


