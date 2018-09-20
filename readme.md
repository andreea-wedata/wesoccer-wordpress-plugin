# WeSoccer Plugin

## Installation

Copy the contents of the repository to `/wp-content/plugins/wesoccer`.


In `/wp-content/plugins/wesoccer`, run `composer install`.

Link to a fixture with events: `{your SWFL root address}/wesoccer-fixture/?id=1961`

Link to a date with fixtures in 3 competitions: `{your SWFL root address}/wesoccer-competition/?date=2018-09-15`


## Adding match data tab to a template

At the end of `themes/website-womenspremierleague/includes/css/main-stylesheet.css` , paste the snippet below:


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

And add a tab to 

`themes/website-womenspremierleague/includes/template-parts/view-fixtures-results.php`

by pasting the code below on line 34:

```html
<li data-tab-child="matchDataTab" data-label="Match Data"><a href="/wesoccer-competition/?date=2018-09-15">Match Data</a></li>
```

## Authentication

In the administration section, in the left side menu, go to `WeSoccer Options`.

To see a list of competitions and their IDs, go to [staging.wesoccer.co.uk/api/v1/competitions](https://staging.wesoccer.co.uk/api/v1/competitions).

In the Competition IDs fields, add the IDs of the competitions you want to be displayed on the site, separated by comma. For example, to display SWPL 1 and SWPL 2, type `59,60` in the field.

To create a user, go to [staging.wesoccer.co.uk/register](https://staging.wesoccer.co.uk/register).

Type the email and password in the fields on the WeSoccer Options page.