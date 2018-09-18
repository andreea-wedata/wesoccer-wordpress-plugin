<?php

require_once('APIReader.php');

/* Template Name: Text Only Content */
get_header();

$fixture_id = $_GET['id'];
$data = APIReader::getResult("http://develop.wesoccer.co.uk/api/v1/fixture/{$fixture_id}");

$fixture = $data['fixture'];
$events = $data['events'];

//die(var_dump($data));
?>
<!-- WORDPRESS TABS -->

    <div id="matchesContainer">
        <div id="pageControls">
            <div class="leagueSwitch">
                <div class="js-dropdown">
                    <div class="activeItem">
                        <span><a href="<?php echo home_url() ?>/wesoccer-competition/?date=2018-09-15"><abbr><?php echo $fixture['competition_short_name'] ?></abbr></a><i class="material-icons">&#xE313;</i></span>
                    </div>
                    <div class="active">
                        <ul>
                            <a href="/fixtures-results"><li data-leagueid="93" data-label="SWPL 1">SWPL 1</li></a>
                            <a href="/fixtures-results"><li data-leagueid="471" data-label="SWPL 2">SWPL 2</li></a>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tabControls">
                <div class="js-dropdown">
                    <div class="activeItem activeTab d-block d-sm-none">
                        <span><a href="/wesoccer-competition/?date=2018-09-15">Match Data</a></span> <i class="material-icons">&#xE313;</i>
                    </div>
                    <ul>
                        <li data-tab-child="fixturesTab" data-label="Fixtures"><a href="/fixtures-results">Fixtures</a></li>
                        <li data-tab-child="resultsTab" data-label="Results"><a href="/fixtures-results">Results</a></li>
                        <li data-tab-child="leagueTableTab" data-label="League Table"><a href="/fixtures-results">League Table & Goals</a></li>
                        <li class="active" data-tab-child="leagueTableTab" data-label="Match Data"><a href="/wesoccer-competition/?date=2018-09-15">Match Data</a></li>
                    </ul>
                </div>
            </div>
        </div>
   

<!-- END OF WORDPRESS TABS -->

<div class="container">

    <div class="col-12">
        <div class="tabTitle">
            <h3><?php echo $fixture['competition_name'] ?></h3>
            <a href="<?php echo home_url() ?>/wesoccer-competition/?date=<?php echo $fixture['link_date'] ?>">
            <?php echo $fixture['friendly_match_date'] ?>
            </a>
        </div>
    </div>


 <!-- 
     STYLES AND MARKUP FROM WESOCCER
 -->

<section class="fixture__section">
    <!-- MATCH HEADER -->
    <div class="heading__wrapper">
        <div class="teams__wrapper">
            <section class="team__block">
                <figure class="team__emblem">
                    <i class="far fa-futbol fa-2x emblem"></i>
                </figure>
                <h4 class="panel__heading name"><?php echo $fixture['home_team']['name'] ?></h4>
                <h4 class="panel__heading shortname">
                    <abbr class="panel__heading"><?php echo $fixture['home_team']['name'] ?></abbr>
                </h4>
            </section>
            <span class="team__separator">v</span>
            <section class="team__block">
                <figure class="team__emblem">
                    <i class="far fa-futbol fa-2x emblem"></i>
                </figure>
                <h4 class="panel__heading name"><?php echo $fixture['away_team']['name'] ?></h4>
                <h4 class="panel__heading shortname">
                    <abbr class="panel__heading"><?php echo $fixture['away_team']['name'] ?></abbr>
                </h4>
            </section>
        </div>
        <div class="score__block">
            <span id="score--events" class="game-score"><?php echo $fixture['home_team']['goals'] ?> &ndash; <?php echo $fixture['away_team']['goals'] ?></span>
            <span id="penalties--events" class="penalties-score">
                <span class="pen-score"><?php echo $fixture['home_team']['penalties'] ?></span>
            <span class="pen__separator uppercase">pens</span>
            <span class="pen-score"><?php echo $fixture['away_team']['penalties'] ?></span>
            </span>
        </div>
        
    </div>
   
    <div id="events--container">
        <table class="fixtures__events">
            <thead></thead>
            <tfoot></tfoot>
            <tbody>
            <?php foreach ($events AS $event): ?>
                <!-- CARD -->

                <?php if ($event['event_type'] == 'card'): ?>
                    <?php if ($event['team_origin'] == 'HOME'): ?>
                    <!-- CARD HOME -->
                    <tr class="card--home">
                        <td colspan="2">
                            <div class="card__box card__box--right">
                                <span class="card__event right">
                                    <span class="card__type"><?php echo $event['card_type'] ?> card - <?php echo $event['player']['last_name'] ?></span>
                                <span class="card__player"><?php echo $event['card_code'] ?> <?php echo $event['card_reason'] ?></span>
                                </span>
                                <span class="card__ico-box">
                                    <span class="card__ico card__ico--yellow" style="background-color:#FFFFFF">
                                        <span class="card__player-num" style="background-color:#FFFFFF"><?php echo $event['player']['shirt_number'] ?></span>
                                    </span>
                                </span>
                            </div>
                        </td>
                        <td class="time__cell">
                            <span class="time">
                                <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>
                            </span>
                        </td>
                        <td colspan="2"></td>
                    </tr>

                    <?php elseif ($event['team_origin'] == 'AWAY'): ?>

                    <!-- CARD AWAY -->
                    <tr class="card--away">
                        <td colspan="2"></td>
                        <td class="time__cell">
                            <span class="time">
                                <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>
                            </span>
                        </td>
                        <td colspan="2">
                            <div class="card__box card__box--left">
                                <span class="card__ico-box">
                                    <span class="card__ico card__ico--yellow" style="background-color:#FFFFFF">
                                        <span class="card__player-num"><?php echo $event['player']['shirt_number'] ?></span>
                                    </span>
                                </span>
                                <span class="card__event left">
                                    <span class="card__type"><?php echo $event['card_type'] ?> card - <?php echo $event['player']['last_name'] ?></span>
                                <span class="card__player"><?php echo $event['card_code'] ?> <?php echo $event['card_reason'] ?></span>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <!-- GOAL -->
                    <?php elseif ($event['event_type'] == 'goal'): ?>
                        <?php if ($event['team_origin'] == 'HOME'): ?>

                        <tr class="goal--home">
                            <td colspan="2">
                                <div class="goal__wrapper goal__box--right">
                                    <div class="goal__event goal__event--left">
                                        <span class="goal"><?php echo $event['goal_type'] ?></span>
                                        <span class="goal__player"><?php echo $event['player']['first_name'] ?> <?php echo $event['player']['last_name'] ?></span>
                                    </div>
                                    <div>
                                        <div class="goal__ico goal__ico--left">
                                            <img class="goal__img" src="<?php echo home_url() ?>/wp-content/plugins/wesoccer/assets/images/football_50px.png" />
                                        </div>
                                        <span class="goal__num goal__num--left" style="background-color:#FFFFFF">
                                            <span class="goal__shirt"><?php echo $event['player']['shirt_number'] ?></span>
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="time__cell">
                                <div class="time">
                                    <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                    <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>
                                </div>
                            </td>
                            <td colspan="2"></td>
                        </tr>


                        <?php elseif ($event['team_origin'] == 'AWAY'): ?>

                        <tr class="goal--away">
                            <td colspan="2"></td>
                            <td class="time__cell">
                                <div class="time">
                                    <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                    <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>
                                </div>
                            </td>
                            <td colspan="2">
                                <div class="goal__wrapper goal__box--left">
                                    <div>
                                        <div class="goal__ico goal__ico--right">
                                            <img class="goal__img" src="<?php echo home_url() ?>/wp-content/plugins/wesoccer/assets/images/football_50px.png" />
                                        </div>
                                        <span class="goal__num goal__num--right" style="background-color:#FFFFFF">
                                            <span class="goal__shirt"><?php echo $event['player']['shirt_number'] ?></span>
                                        </span>
                                    </div>
                                    <div class="goal__event goal__event--right">
                                        <span class="goal"><?php echo $event['goal_type'] ?></span>
                                        <span class="goal__player"><?php echo $event['player']['first_name'] ?> <?php echo $event['player']['last_name'] ?> </span>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <?php endif; ?>

                        <!-- SUBSTITUTION -->
                        <?php elseif ($event['event_type'] == 'substitution'): ?>
                            <?php if ($event['team_origin'] == 'HOME'): ?>
                                <tr class="subs--home">
                                    <td colspan="2">
                                        <!-- Player ON -->
                                        <div class="player__box player__box--right">
                                            <span class="player">
                                                <?php echo $event['player_on']['last_name'] ?> ON
                                            </span>
                                            <span class="player__num" style="background-color:#FFFFFF"><?php echo $event['player_on']['shirt_number'] ?></span>
                                            <span class="sub__ico">↑</span>
                                        </div>

                                        <!-- Player OFF -->
                                        <div class="player__box player__box--right">
                                            <span class="player">
                                                <?php echo $event['player_out']['last_name'] ?> OFF
                                            </span>
                                            <span class="player__num" style="background-color:#FFFFFF"><?php echo $event['player_out']['shirt_number'] ?></span>
                                            <span class="sub__ico">↓</span>
                                        </div>
                                    </td>

                                    <td class="time__cell">
                                        <div class="time">
                                            <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                            <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>

                                        </div>
                                    </td>
                                    <td colspan="2"></td>
                                </tr>

                                <?php elseif ($event['team_origin'] == 'AWAY'): ?>

                                    <tr class="subs--away">
                                        <td colspan="2"></td>
                                        <td class="time__cell">
                                            <div class="time">
                                                <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                                <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>

                                            </div>
                                        </td>
                                        <td colspan="2">
                                            <!-- Player ON -->
                                            <div class="player__box player__box--left">
                                                <span class="sub__ico">↑</span>
                                                <span class="player__num" style="background-color:#FFFFFF"><?php echo $event['player_on']['shirt_number'] ?></span>
                                                <span class="player left">
                                                    <?php echo $event['player_on']['last_name'] ?> ON
                                                </span>
                                            </div>

                                            <!-- Player OFF -->
                                            <div class="player__box player__box--left">
                                                <span class="sub__ico">↓</span>
                                                <span class="player__num" style="background-color:#FFFFFF"><?php echo $event['player_out']['shirt_number'] ?>1</span>
                                                <span class="player left">
                                                    <?php echo $event['player_out']['last_name'] ?> OFF
                                                </span>
                                            </div>
                                        </td>
                                    </tr>

                                <?php endif; ?>

                        <!-- TIME EVENT -->
                        <?php elseif ($event['event_type'] == 'time'): ?>
                        <tr>
                            <td colspan="2">
                                <div class="time__box">
                                    <span class="time__period"><?php echo $event['time_event_type'] ?> <?php echo $event['period_number'] ?> <?php echo $event['time_event_status'] ?></span>
                                    <img class="stopwatch__ico" src="<?php echo home_url() ?>/wp-content/plugins/wesoccer/assets/images/stopwatch_50px.png" />
                                </div>
                            </td>
                            <td class="time__cell">
                                <span class="time">
                                    <span class="time--full"><?php echo $event['time']['minutes'].":".$event['time']['seconds'] ?></span>
                                    <span class="time--event"><?php echo $event['extra_time']['minutes'].":".$event['extra_time']['seconds'] ?></span>
                                </span>
                            </td>
                            <td colspan="2"></td>
                        </tr>


                    <?php endif; ?>


                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</section>


<!-- 
     END OF STYLES AND MARKUP FROM WESOCCER
-->

/*
<div id="">
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

*/


</div>
</div>

<?php

get_footer();

?>