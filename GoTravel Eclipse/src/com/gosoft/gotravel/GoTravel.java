package com.gosoft.gotravel;

import org.apache.cordova.DroidGap;

import android.os.Bundle;
import android.view.Menu;
import android.view.MenuItem;

public class GoTravel extends DroidGap {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        super.setIntegerProperty("splashscreen", R.drawable.s);
        super.setIntegerProperty("loadUrlTimeoutValue", 60000);
        super.loadUrl("file:///android_asset/www/index.html");
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.activity_go_travel, menu);
        return true;
    }
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
    	// TODO Auto-generated method stub
    	if(item.getItemId() == R.id.keluar){
    		finish();
    	}
    	return super.onOptionsItemSelected(item);
    }
    
}
