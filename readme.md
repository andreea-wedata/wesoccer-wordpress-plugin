# WeSoccer Plugin

## Installation

### Dependencies
We use the Composer Package Manager for PHP. Please install composer following the instructions on their website: [getcomposer.org](https://getcomposer.org/).


### Installing the plugin
Copy the contents of the repository to `/wp-content/plugins/wesoccer`. (N.B. you may need to rename the folder once you download it from Github.)

In `/wp-content/plugins/wesoccer`, run `php composer install`.
A successful run of the php composer install script successfully should give the following output and create a /vendors folder within your wesoccer plugin folder.

```
$ php composer install

Loading composer repositories with package information
Installing dependencies (including require-dev) from lock file
Package operations: 4 installs, 0 updates, 0 removals
  - Installing psr/http-message (1.0.1): Downloading (100%)         
  - Installing guzzlehttp/psr7 (1.4.2): Downloading (100%)         
  - Installing guzzlehttp/promises (v1.3.1): Downloading (100%)         
  - Installing guzzlehttp/guzzle (6.3.3): Downloading (100%)         
guzzlehttp/guzzle suggests installing psr/log (Required for using the Log middleware)
Generating autoload files
```

### Activating the plugin
Activate the plugin in the standard way by clicking the activate link on the Wordpress Plugin Admin page (/wp-admin/plugins.php).


## Authentication
The plugin requires an authenticated account on [staging.wesoccer.co.uk](https://staging.wesoccer.co.uk/) to consume data.

Firstly, to create a user, go to [staging.wesoccer.co.uk/register](https://staging.wesoccer.co.uk/register) and sign up following the instructions on that site.

You will also need to identify the competitions that you want to include in your data feed.
To see a list of competitions and their IDs, go to [staging.wesoccer.co.uk/api/v1/competitions](https://staging.wesoccer.co.uk/api/v1/competitions).
Note down the ids of any competitions you wish to include.

Then go to the Wordpress Admin page and select `WeSoccer Options` in the left hand menu.

In the Competition IDs fields, add the IDs of the competitions you want to be displayed on the site, separated by comma. For example, to display SWPL 1 and SWPL 2, type `59,60` in the field.

Then use the credentials you created on the wesoccer website to complete the `WeSoccer API Email` and `WeSoccer API Password` fields.

Note that you will need to enter your API password each time you make a change to the WeSoccer Options.

  
## Checking that the plugin can connect and retrieve data from the We.data API
Check the following links in your browser:

Link to a fixture with events: `{your website root address}/wesoccer-fixture/?id=1961`

Link to a date with fixtures: `{your website root address}/wesoccer-competition/?date=2018-09-23`


## Adding match data tab to a template in the SWPL theme
To integrate the plugin with the bespoke theme on the SWPL website, we suggest the following:

At the end of `/wp-content/themes/website-womenspremierleague/includes/css/main-stylesheet.css`, paste the snippet below:


## Main theme overrides

```css
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
```

And to add a tab to the /fixtures-results/ page, open the file:

`/wp-content/themes/website-womenspremierleague/includes/template-parts/views/view-fixtures-results.php`


paste the code below on line 34:

```php
<li data-tab-child="matchDataTab" data-label="Match Data"><a href="/wesoccer-competition/?date=<?php echo date('Y-m-d') ?>">Match Data</a></li>
```
so that your list becomes;

```php
        <ul>
          <li class="active" data-tab-child="fixturesTab" data-label="Fixtures">Fixtures</li>
          <li data-tab-child="resultsTab" data-label="Results">Results</li>
          <li data-tab-child="leagueTableTab" data-label="League Table">League Table & Goals</li>
          <li data-tab-child="matchDataTab" data-label="Match Data"><a href="/wesoccer-competition/?date=<?php echo date('Y-m-d') ?>">Match Data</a></li>
        </ul>
```



