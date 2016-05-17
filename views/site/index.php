<?php

/* @var $this yii\web\View */

$this->title = 'Cyclings Dirty Era';

//if no year set, set to 1999
if (!isset($_GET['year'])) {
    $year=1999;
}
else {
   $year = $_GET['year']; 
}
?>
<div class="site-index">
    <div class="text-center">
        <label for="tourYear">Tour Year:</label>
        <select id="tourYear">
            <option value="1999" <?php if(1999==$year) { echo "selected"; } ?>>1999</option>
            <option value="2000" <?php if(2000==$year) { echo "selected"; } ?>>2000</option>
            <option value="2001" <?php if(2001==$year) { echo "selected"; } ?>>2001</option>
            <option value="2002" <?php if(2002==$year) { echo "selected"; } ?>>2002</option>
            <option value="2003" <?php if(2003==$year) { echo "selected"; } ?>>2003</option>
            <option value="2004" <?php if(2004==$year) { echo "selected"; } ?>>2004</option>
            <option value="2005" <?php if(2005==$year) { echo "selected"; } ?>>2005</option>
        </select>
    </div>

    <div class="body-content">

        <div class="row">
            <table class="table table-hover">
                <tr>
                    <th>Place</th>
                    <th>Cyclist Name</th>
                    <th>Doper</th>
                    <th>Doper Description</th>
                    <th>Official DQ</th>
                    <th>Ban Length</th>
                </tr>
                    <?php
                        for ($i=0;$i<count($data);$i++) {
                            echo "<tr>";
                            echo "<td>{$data[$i]['result_place']}</td>";
                            echo "<td>{$data[$i]['name']}</td>";
                            echo "<td>{$data[$i]['doper']}</td>";
                            echo "<td>{$data[$i]['bans']}</td>";
                            echo "<td>{$data[$i]['dq']}</td>";
                            echo "<td>{$data[$i]['ban_length']}</td>";
                            echo "<tr>";
                        }
                    ?>
                
            </table>
        </div>

    </div>
</div>
