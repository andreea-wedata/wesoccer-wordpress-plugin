<?php

require_once('APIReader.php');

/* Template Name: Text Only Content */
get_header();

$date = $_GET['date'];
$ids = get_option('wesoccer_competition_ids')['wesoccer_field_competitions'];
$data = APIReader::getResult("http://staging.wesoccer.co.uk/api/v1/fixtures/competitions/{$ids}/date/{$date}");
$grouped_fixtures = [];
foreach ($data['fixtures'] as $element) {
    $grouped_fixtures[$element['group_by']][] = $element;
}
$data['fixtures'] = $grouped_fixtures;
?>

<!-- WORDPRESS TABS -->

<div id="matchesContainer">
    <div id="pageControls">
        <div class="leagueSwitch">
            <div class="js-dropdown">
                <div class="activeItem activeLeague">
                    <span><a class="plugin__link" href="<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo date('Y-m-d') ?>">Competition Name</a><i class="material-icons">&#xE313;</i></span>
                </div>
                <div class="active">
                    <ul>
                        <li class="wesoccer__tab" data-leagueid="93" data-label="SWPL 1"><a class="plugin-dropdown__link" href="/fixtures-results">SWPL 1</a></li>
                        <li class="wesoccer__tab" data-leagueid="471" data-label="SWPL 2"><a class="plugin-dropdown__link" href="/fixtures-results">SWPL 2</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="tabControls">
            <div class="js-dropdown">
                <div class="activeItem activeTab d-block d-sm-none">
                    <span><a href="<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo date('Y-m-d') ?>">Match Data</a></span> <i class="material-icons">&#xE313;</i>
                </div>
                <ul>
                    <li data-tab-child="fixturesTab" data-label="Fixtures"><a href="/fixtures-results">Fixtures</a></li>
                    <li data-tab-child="resultsTab" data-label="Results"><a href="/fixtures-results">Results</a></li>
                    <li data-tab-child="leagueTableTab" data-label="League Table"><a href="/fixtures-results">League Table & Goals</a></li>
                    <li class="active" data-tab-child="leagueTableTab" data-label="Match Data"><a href="/wesoccer-competition/?date=<?php echo date('Y-m-d') ?>">Match Data</a></li>
                </ul>
            </div>
        </div>
    </div>
   

<!-- END OF WORDPRESS TABS -->

    <div class="container">

        <div class="col-12">
            <div class="tabTitle">
                <h3>Match Data</h3>
            </div>
        </div>


        <!-- 
            STYLES AND MARKUP FROM WESOCCER
        -->
        <section class="fixtures">
        
            <!-- TIMELINE -->
            <div class="fx-timeline__wrapper">
                <!-- Left arrow  -->
                <button id="prev_btn" class="timeline__btn" type="button" name="button">
                    <i class="fa fa-chevron-left"></i>
                </button>

                <div id="timeline" class="timeline">
                    <div class="timeline__lists">
                        <div class="timeline__group">
                            <ul id="list" class="timeline__list margin--clear">

                                <?php foreach ($data['dates'] AS $date): ?>

                                    <li class='timeline__listitem'>

                                        <?php if($date['selected']) : ?>
                                            <a class='timeline__link timeline__link--active' href='<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo $date['link_date']; ?>'><?php echo $date['name'] ?> <?php echo $date['day'] ?> <?php echo $date['month']['M'] ?></a>

                                        <?php else : ?>
                                            <a class='timeline__link' href='<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo $date['link_date']; ?>'><?php echo $date['name'] ?> <?php echo $date['day'] ?> <?php echo $date['month']['M'] ?></a>

                                        <?php endif; ?>
                                        
                                    </li>

                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Right arrow  -->
                <button id="next_btn" class="timeline__btn" type="button" name="button">
                    <i class="fa fa-chevron-right"></i>
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
                                            <?php if($fixture['status'] === 'WAITING') : ?>
                                                <span class="kickoff_time--fixture visually-hidden">
                                                    00:00
                                                </span>

                                                <?php else : ?>
                                                <span class="kickoff_time--fixture">
                                                    <?php echo $fixture['start_time']['hours'] ?>:<?php echo $fixture['start_time']['minutes'] ?>
                                                </span>

                                            <?php endif; ?>

                                        
                                            <!-- Home team block -->
                                            <div class="fixture__team">
                                                <div class="fixture__team--home">
                                                    <span class="fixture__team-name"><?php echo $fixture['home_team']['name'] ?></span>
                                                    <abbr class="fixture__team-shortname"><?php echo $fixture['home_team']['name'] ?></abbr>
                                                    <div class="fixture__emblem">
                                                        <i class="far fa-futbol"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Score block -->
                                            
                                            <div class="fixture__block">
                                                <div class="fixture__box">

                                                    <?php if($fixture['status'] === 'ENDED') : ?>
                                                        <span class="fixture__num fixture__num--completed">
                                                            <span><?php echo $fixture['home_team']['goals'] ?></span>
                                                        </span>

                                                        <span class="fixture__separator">&ndash;</span>

                                                        <span class="fixture__num fixture__num--completed">
                                                            <span><?php echo $fixture['away_team']['goals'] ?></span>
                                                        </span>

                                                    <?php elseif($fixture['status'] === 'STARTED') : ?>
                                                        <span class="fixture__num fixture__num--play">
                                                            <span><?php echo $fixture['home_team']['goals'] ?></span>
                                                        </span>

                                                        <span class="fixture__separator">&ndash;</span>

                                                        <span class="fixture__num fixture__num--play">
                                                            <span><?php echo $fixture['away_team']['goals'] ?></span>
                                                        </span>

                                                    <?php elseif($fixture['status'] === 'PAUSED') : ?>
                                                        <span class="fixture__num fixture__num--period">
                                                            <span><?php echo $fixture['home_team']['goals'] ?></span>
                                                        </span>

                                                        <span class="fixture__separator">&ndash;</span>

                                                        <span class="fixture__num fixture__num--period">
                                                            <span><?php echo $fixture['away_team']['goals'] ?></span>
                                                        </span>

                                                    <?php else : ?>

                                                        <span class="fixture__time" aria-label="kick-off time">
                                                            <?php echo $fixture['start_time']['hours'] ?>:<?php echo $fixture['start_time']['minutes'] ?>
                                                        </span>
                                
                                                    <?php endif; ?>

                                                </div>

                                                <?php if($fixture['home_team']['penalties'] || $fixture['away_team']['penalties']) : ?>
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

                                                <?php endif; ?>
                                            </div>

                                            <!-- Away team block -->
                                            <div class="fixture__team">
                                                <div class="fixture__team--away">
                                                    <div class="fixture__emblem">
                                                        <i class="far fa-futbol"></i>
                                                    </div>
                                                    <span class="fixture__team-name"><?php echo $fixture['away_team']['name'] ?></span>
                                                    <abbr class="fixture__team-shortname"><?php echo $fixture['away_team']['name'] ?></abbr>
                                                </div>
                                            </div>

                                            <!-- Game time -->
                                            <?php if($fixture['status'] === 'ENDED') : ?>
                                                <span class="ft--fixture">
                                                    <span aria-label="full-time">
                                                    FT
                                                    </span>
                                                </span>

                                            <?php elseif($fixture['status'] === 'STARTED' || $fixture['status'] === 'PAUSED' ): ?>
                                                <span class="game_time--fixture">
                                                    <span>
                                                        <?php echo $fixture['minutes'] ?>&prime;
                                                    </span>
                                                </span>
                                                
                                            <?php else : ?>
                                                <span class="game_time--fixture visually-hidden">
                                                    <span>
                                                    00'
                                                    </span>
                                                </span>

                                            <?php endif; ?>
                                            

                                        </div>
                                    </article>
                                </a>
                            </li>
                            <!-- End of fixture row  -->

                        </ul>
                    </div>
                    <?php endforeach; ?>
                </section>

        
            <?php endforeach; ?>

        
        </section>

    </div>


<!-- 
    END OF STYLES AND MARKUP FROM WESOCCER
-->
</div>


<?php

get_footer();

?>


<!-- 
    REDUNDANT MARKUP
-->

<!-- 
<div id='dates--container'>
    <table>
        <tr>
            <?php /*foreach ($data['dates'] AS $date): ?>
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
    <?php endforeach;// */ ?>
</div>
-->
   