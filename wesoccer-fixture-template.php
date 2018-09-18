<?php

require_once('APIReader.php');

/* Template Name: Text Only Content */
get_header();

$fixture_id = $_GET['id'];
$data = APIReader::getResult("http://wesoccer.test/api/v1/fixture/{$fixture_id}");

$fixture = $data['fixture'];
$events = $data['events'];

//die(var_dump($data));
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

<section class="fx-league">
    <h4 class="list__heading fx-league__heading">
        <?php echo $fixture['competition_name'] ?>
        <abbr><?php echo $fixture['competition_short_name'] ?><abbr>
    </h4>
    <a href="<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo $fixture['link_date'] ?>">
        <?php echo $fixture['friendly_match_date'] ?>
    </a>
    

    
    <div id='fixture--container' class="flex__wrapper--lg-desktop">

        <ul class="fx-league__list">

            <!-- Fixture row-->
            <li class="fx-league__listitem">

                <a class="fx-league__link" href="<?php echo home_url() ?>/wesoccer-fixture/?id=<?php echo $fixture['id']; ?>">

                    <!-- Fixture with scores -->
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
</section>

<!-- 
     END OF STYLES AND MARKUP FROM WESOCCER
-->


<div id="competition-data--container">
    <table>
        <tr>
            <td id="competition-name"><?php echo $fixture['competition_name'] ?></td>
            <td id="competition-short-name"><?php echo $fixture['competition_short_name'] ?></td>
        </tr>
        <tr>
            <td id="link-back-to-fixtures">
                <a href="<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo $fixture['link_date'] ?>">
                    <?php echo $fixture['friendly_match_date'] ?>
                </a>
            </td>
            <td id="start-time"><?php echo $fixture['start_time']['hours'].":".$fixture['start_time']['minutes'] ?></td>
            <td id="game-time"><?php echo $fixture['minutes'] ?></td>
            <td id="match-status"><?php echo $fixture['match_status'] ?></td>
            <td id="match-datetime"><?php echo $fixture['match_datetime'] ?></td>
        </tr>
    </table>
    <table>
        <tr id="home-team--container">
            <td><?php echo $fixture['home_team']['name'] ?></td>
            <td><?php echo $fixture['home_team']['goals'] ?></td>
            <td><?php echo $fixture['home_team']['penalties'] ?></td>
        </tr>
        <tr id="away-team--container">
            <td><?php echo $fixture['away_team']['name'] ?></td>
            <td><?php echo $fixture['away_team']['goals'] ?></td>
            <td><?php echo $fixture['away_team']['penalties'] ?></td>
        </tr>
    </table>
</div>

<div id="events--container">
    <table>
        <?php foreach ($events AS $event): ?>
        <tr id="event--container">
            <!-- CARD -->
            <?php if ($event['event_type'] == 'card'): ?>
                
                <?php if ($event['team_origin'] == 'HOME'): ?>
                    <td><?php echo $event['team_name'] ?></td>
                    <td><?php echo $event['team_short_name'] ?></td>
                    <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                    <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                    <td><?php echo $event['shirt_colour'] ?></td>
                    <td><?php echo $event['card_type'] ?></td>
                    <td><?php echo $event['card_code'] ?></td>
                    <td><?php echo $event['card_reason'] ?></td>
                    <td><?php echo $event['player']['first_name'] ?></td>
                    <td><?php echo $event['player']['last_name'] ?></td>
                    <td><?php echo $event['player']['shirt_number'] ?></td>
                
                <?php elseif ($event['team_origin'] == 'AWAY'): ?>
                    <td><?php echo $event['team_name'] ?></td>
                    <td><?php echo $event['team_short_name'] ?></td>
                    <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                    <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                    <td><?php echo $event['shirt_colour'] ?></td>
                    <td><?php echo $event['card_type'] ?></td>
                    <td><?php echo $event['card_code'] ?></td>
                    <td><?php echo $event['card_reason'] ?></td>
                    <td><?php echo $event['player']['first_name'] ?></td>
                    <td><?php echo $event['player']['last_name'] ?></td>
                    <td><?php echo $event['player']['shirt_number'] ?></td>
                <?php endif; ?>
            <!-- GOAL -->
            <?php elseif ($event['event_type'] == 'goal'): ?>
                <?php if ($event['team_origin'] == 'HOME'): ?>
                    <td><?php echo $event['team_name'] ?></td>
                    <td><?php echo $event['team_short_name'] ?></td>
                    <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                    <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                    <td><?php echo $event['shirt_colour'] ?></td>
                    <td><?php echo $event['goal_type'] ?></td>
                    <td><?php echo $event['player']['first_name'] ?></td>
                    <td><?php echo $event['player']['last_name'] ?></td>
                    <td><?php echo $event['player']['shirt_number'] ?></td>
                <?php elseif ($event['team_origin'] == 'AWAY'): ?>
                    <td><?php echo $event['team_name'] ?></td>
                    <td><?php echo $event['team_short_name'] ?></td>
                    <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                    <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                    <td><?php echo $event['shirt_colour'] ?></td>
                    <td><?php echo $event['goal_type'] ?></td>
                    <td><?php echo $event['player']['first_name'] ?></td>
                    <td><?php echo $event['player']['last_name'] ?></td>
                    <td><?php echo $event['player']['shirt_number'] ?></td>
                <?php endif; ?>
            <!-- SUBSTITUTION -->
            <?php elseif ($event['event_type'] == 'substitution'): ?>
                <?php if ($event['team_origin'] == 'HOME'): ?>
                    <td><?php echo $event['team_name'] ?></td>
                    <td><?php echo $event['team_short_name'] ?></td>
                    <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                    <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                    <td><?php echo $event['shirt_colour'] ?></td>
                    <td><?php echo $event['player_on']['first_name'] ?></td>
                    <td><?php echo $event['player_on']['last_name'] ?></td>
                    <td><?php echo $event['player_on']['shirt_number'] ?></td>
                    <td><?php echo $event['player_out']['first_name'] ?></td>
                    <td><?php echo $event['player_out']['last_name'] ?></td>
                    <td><?php echo $event['player_out']['shirt_number'] ?></td>
                <?php elseif ($event['team_origin'] == 'AWAY'): ?>
                    <td><?php echo $event['team_name'] ?></td>
                    <td><?php echo $event['team_short_name'] ?></td>
                    <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                    <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                    <td><?php echo $event['shirt_colour'] ?></td>
                    <td><?php echo $event['player_on']['first_name'] ?></td>
                    <td><?php echo $event['player_on']['last_name'] ?></td>
                    <td><?php echo $event['player_on']['shirt_number'] ?></td>
                    <td><?php echo $event['player_out']['first_name'] ?></td>
                    <td><?php echo $event['player_out']['last_name'] ?></td>
                    <td><?php echo $event['player_out']['shirt_number'] ?></td>
                <?php endif; ?>
            <!-- TIME -->
            <?php elseif ($event['event_type'] == 'time'): ?>
                <td><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></td>
                <td><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></td>
                <td><?php echo $event['time_event_type'] ?></td> <!-- EXTRA_TIME_PERIOD/MATCH/PENALTIES/PERIOD -->
                <td><?php echo $event['time_event_status'] ?></td>
                <td><?php echo $event['period_number'] ?></td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php

get_footer();

?>