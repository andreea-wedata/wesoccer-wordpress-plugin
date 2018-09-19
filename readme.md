# WeSoccer Plugin

##Installation

Copy the contents of the repository to `/wp-content/plugins/wesoccer`.

in /wp-content/plugins/wesoccer, run `composer install`.

link to a fixture with events: {your SWFL root address}/wesoccer-fixture/?id=1961

link to a date with fixtures in 3 competitions: {your SWFL root address}/wesoccer-competition/?date=2018-09-15


/* ADDING MATCH DATA TAB TO A TEMPLATE */

Paste this snippet at the end of 

themes/website-womenspremierleague/includes/css/main-stylesheet.css 

/**
  ===============================
  ---> MAIN THEME OVERRIDES <----
  ===============================
  */

  #matchesContainer #pageControls .tabControls ul li:last-child {
    padding: 0;
  }

  #matchesContainer #pageControls .tabControls ul li a:last-child {
    padding: 20px 15px;
  }

  #matchesContainer #pageControls .tabControls ul li a {
    text-decoration: none!important;
    color: black!important;
    display: block;
    width: 100%;
    height: 100%;
  }

  @media screen and (min-width: 768px) {
    #matchesContainer #pageControls .tabControls ul li {
      max-width: 25%!important;
    }
  }


and add a tab to 

themes/website-womenspremierleague/includes/template-parts/view-fixtures-results.php

on line 34

<li data-tab-child="matchDataTab" data-label="Match Data"><a href="/wesoccer-competition/?date=<?php echo date('Y-m-d') ?>">Match Data</a></li>