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
    
</div>

<?php

get_footer();

?>