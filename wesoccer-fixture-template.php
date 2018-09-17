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