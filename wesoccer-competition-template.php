<?php

require_once('APIReader.php');

/* Template Name: Text Only Content */
get_header();

$date = $_GET['date'];
$data = APIReader::getResult("http://develop.wesoccer.co.uk/api/v1/fixtures/competitions/9,45,76/date/{$date}");
$grouped_fixtures = [];
foreach ($data['fixtures'] as $element) {
    $grouped_fixtures[$element['group_by']][] = $element;
}
$data['fixtures'] = $grouped_fixtures;
?>

<!-- WORDPRESS TABS -->
<div id="pageControls">
    <div class="leagueSwitch">
        <div class="js-dropdown">
            <div class="activeItem activeLeague">
                <a href="/fixtures-results"><span>SWPL1</span> <i class="material-icons">&#xE313;</i></a>
            </div>
            <!-- <div class="active">
                <ul>
                    <li data-leagueid="93" data-label="SWPL 1">SWPL 1</li>
                    <li data-leagueid="471" data-label="SWPL 2">SWPL 2</li>
                </ul>
            </div> -->
        </div>
    </div>
    <div class="tabControls">
        <div class="js-dropdown">
            <div class="activeItem activeTab d-block d-sm-none">
                <span>Fixtures</span> <i class="material-icons">&#xE313;</i>
            </div>
            <ul>
                <li class="active" data-tab-child="fixturesTab" data-label="Fixtures"><a href="/fixtures-results">Fixtures</a></li>
                <li data-tab-child="resultsTab" data-label="Results"><a href="/fixtures-results">Results</a></li>
                <li data-tab-child="leagueTableTab" data-label="League Table"><a href="/fixtures-results">League Table & Goals</a></li>
                <li data-tab-child="leagueTableTab" data-label="League Table"><a href="/wesoccer-competition/?date=2018-09-15">Match Data</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- END OF WORDPRESS TABS -->

<!-- 
     STYLES AND MARKUP FROM WESOCCER
-->
<section class="fixtures">
    <header>
        <h2 class="page__heading">Match Data</h2>
    </header>
        <!-- TIMELINE -->
        <div class="fx-timeline__wrapper">
            <!-- Left arrow  -->
            <button id="prev_btn" class="timeline__btn" type="button" name="button">
            <i class="material-icons md-48">
                keyboard_arrow_left
            </i>
            </button>

            <div id="timeline" class="timeline">
                <div class="timeline__lists">
                    <div class="timeline__group">
                        <ul id="list" class="timeline__list margin--clear">

                            <?php foreach ($data['dates'] AS $date): ?>

                                <li class='timeline__listitem'>
                                    <a class='timeline__link' href='#'><?php echo $date['name'] ?><?php echo $date['friendly_date'] ?></a>
                                </li>

                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Right arrow  -->
            <button id="next_btn" class="timeline__btn" type="button" name="button">
            <i class="material-icons md-48">
                keyboard_arrow_right
            </i>
            </button>
        </div>

        <!-- FIXTURES LIST -->
        <div id='fixtures-container' class="fx__content">
            <?php foreach ($data['fixtures'] AS $competition_name => $fixtures): ?>

            <section class="fx-league">
                <h4 class="list__heading fx-league__heading"><?php echo $competition_name; ?></h4>
                <?php foreach ($fixtures AS $fixture): ?>

                <div id='fixture--container' class="flex__wrapper--lg-desktop">
                    <ul class="fx-league__list">

                        <!-- Fixture row-->
                        <li class="fx-league__listitem">
                            <a class="fx-league__link" href="<?php echo home_url() ?>/wesoccer-fixture/?id=<?php echo $fixture['id']; ?>">

                                <article class="fx-league__fixture">
                                    <div class="fx-league__fixture-wrapper">

                                        <!--Kick-off time -->
                                        <span class="kickoff_time--fixture">
                                            <?php echo $fixture['start_time']['hours'] ?>:<?php echo $fixture['start_time']['minutes'] ?>
                                        </span>

                                       
                                        <!-- Home team block -->
                                        <div class="fixture__team">
                                            <div class="fixture__team--home">
                                                <span class="fixture__team-name"><?php echo $fixture['home_team']['name'] ?></span>
                                                <abbr class="fixture__team-shortname"><?php echo $fixture['home_team']['name'] ?></abbr>
                                                <div class="fixture__emblem">
                                                    <i class="material-icons">
                                                        insert_emoticon
                                                    </i>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Score block -->
                                        <div class="fixture__block">
                                            <div class="fixture__box">
                                                <span class="fixture__num ">
                                                    <span><?php echo $fixture['home_team']['goals'] ?></span>
                                                </span>

                                                <span class="fixture__separator">&ndash;</span>

                                                <span class="fixture__num ">
                                                    <span><?php echo $fixture['away_team']['goals'] ?></span>
                                                </span>

                                            </div>
                                            <div class="penalties__box">
                                                <div class="penalties">
                                                    <span class="penalties__num ">
                                                         <span><?php echo $fixture['home_team']['penalties'] ?></span>
                                                    </span>

                                                    <span class="fixture__note">PENS</span>
                                                    <span class="penalties__num ">
                                                        <span><?php echo $fixture['away_team']['penalties'] ?></span>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>

                                        <!-- Away team block -->
                                        <div class="fixture__team">
                                            <div class="fixture__team--away">
                                                <div class="fixture__emblem">
                                                    <i class="material-icons">
                                                        insert_emoticon
                                                    </i>
                                                </div>
                                                <span class="fixture__team-name"><?php echo $fixture['away_team']['name'] ?></span>
                                                <abbr class="fixture__team-shortname"><?php echo $fixture['away_team']['name'] ?></abbr>
                                            </div>
                                        </div>

                                        <!-- Game time -->
                                        <span class="game_time--fixture">
                                            <span>
                                                <?php echo $fixture['minutes'] ?>&prime;
                                            </span>
                                        </span>

                                    </div>
                                </article>
                            </a>
                        </li>
                        <!-- End of fixture row  -->

                    </ul>
                </div>
                <?php endforeach; ?>
            </section>

        </div>
        <?php endforeach; ?>

    </div>   
</section>

<!-- 
    END OF STYLES AND MARKUP FROM WESOCCER
-->

<div id='dates--container'>
    <table>
        <tr>
            <?php foreach ($data['dates'] AS $date): ?>
            <td>
                <a href="<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo $date['link_date']; ?>">
                    <table>
                        <tr><td><?php echo $date['name'] ?></td></tr> <!-- the name of the weekday (Monday) or 'Today' is it's today's date -->
                        <tr><td><?php echo $date['friendly_date'] ?></td></tr> <!-- 01 Sep 2018 -->
                        <tr><td><?php echo $date['selected'] ?></td></tr> <!-- if this is true, apply the selected date style -->
                        <tr><td><?php echo $date['day'] ?></td></tr> <!-- 01 -->
                        <tr><td><?php echo $date['month']['m'] ?></td></tr> <!-- the month number. eg. 09 -->
                        <tr><td><?php echo $date['month']['M'] ?></td></tr> <!-- the month short name. eg. Sep -->
                        <tr><td><?php echo $date['year'] ?></td></tr> <!-- 2018 -->
                    </table>
                </a>
            </td>
            <?php endforeach; ?>
        </tr>
    </table>
</div>

<div id='fixtures--container'>
    <?php foreach ($data['fixtures'] AS $competition_name => $fixtures): ?>
    <div id='competition--container'>
        <div><h2><?php echo $competition_name; ?></h2></div>
        <?php foreach ($fixtures AS $fixture): ?>
        <div id='fixture--container'>
            <a href="<?php echo home_url() ?>/wesoccer-fixture/?id=<?php echo $fixture['id']; ?>">
                <table>
                    <tr>
                        <td>
                            <td><?php echo $fixture['start_time']['hours'] ?></td> <!-- the hour part of the start time of the match -->
                            <td><?php echo $fixture['start_time']['minutes'] ?></td> <!-- the minutes part of the start time of the match -->
                            <td><?php echo $fixture['home_team']['name'] ?></td> <!-- home team name -->
                            <td><?php echo $fixture['home_team']['goals'] ?></td> <!-- number -->
                            <td><?php echo $fixture['home_team']['penalties'] ?></td> <!-- number -->
                            <td><?php echo $fixture['away_team']['name'] ?></td> <!-- away team name -->
                            <td><?php echo $fixture['away_team']['goals'] ?></td> <!-- number -->
                            <td><?php echo $fixture['away_team']['penalties'] ?></td> <!-- number -->
                            <td><?php echo $fixture['status'] ?></td> <!-- the status of the game can be: WAITING, STARTED, PAUSED, ENDED -->
                            <td><?php echo $fixture['minutes'] ?></td> <!-- the game time, in minutes -->
                        </td>
                    </tr>
                </table>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
    <?php endforeach; ?>
</div>

<?php

get_footer();

?>