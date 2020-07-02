<table>
    <?php
        if (!empty($data))
        {
            //create heading
            echo "<tr>";
            foreach($data[0] as $title => $content)
            {
                echo "<td>$title</td>";
            }
            echo "</tr>";

            //table main body
            foreach($data as $row)
            {
                echo "<tr>";
                foreach($row as $title => $content)
                {
                    echo "<td>$content</td>";
                }
                echo "</tr>";
            }
        }
        else
        {
            echo "<p style='color: green'>NO DATA HERE YET ...</p>";
        }

    ?>
</table>
<a href="/main/import">Go to upload page</a>