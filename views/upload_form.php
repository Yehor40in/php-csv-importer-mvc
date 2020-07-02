<?php

    if ( !empty($errors) )
    {
        foreach ($errors as $error)
        {
            echo "<p style='color:red'>$error</p>";
        }
    }
?>

<form action="/main/import" method="post" enctype="multipart/form-data">
    Select a csv file to import:
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <input type="file" name="upload_file">
    <input type="submit" name="submit">
</form>

<?php
    if ( $success )
    {
        echo "<p style='color:green'>File successfully uploaded!</p>";
    }
?>

<a href="/main/list">Go to preview</a>