<?php
defined('ABSPATH') or die("restricted access");
  if ( isset( $_GET['in_msg'] ) && $_GET['in_msg'] == 'suc' )
  {
	  echo "<div id='message' class='updated notice notice-success'><p>New notification category has been created.</p></div>";
  }
  if ( isset( $_GET['ed_msg'] ) && $_GET['ed_msg'] == 'suc' )
  {
	  echo "<div id='message' class='updated notice notice-success'><p>Notification category has been updated.</p></div>";
  }
  if ( isset( $_GET['dl_msg'] ) && $_GET['dl_msg'] == 'suc' )
  {
	  echo "<div id='message' class='updated notice notice-success'><p>Notification category has been deleted.</p></div>";
  }