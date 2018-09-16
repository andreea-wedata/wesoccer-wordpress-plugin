<?php

require_once('APIReader.php');

/* Template Name: Text Only Content */
get_header();

$date = $_GET['date'];
$data = APIReader::getResult("http://wesoccer.test/api/v1/fixtures/competitions/9,45,76/date/{$date}");
$grouped_fixtures = [];
foreach ($data['fixtures'] as $element) {
    $grouped_fixtures[$element['group_by']][] = $element;
}
$data['fixtures'] = $grouped_fixtures;
?>

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