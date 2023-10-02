<?php 
function connectToMongoDB()
{
    $connectionString = "mongodb://localhost:27017"; // Change the connection string as needed

    // $connectionString = "mongodb+srv://riju88:Mongodb_Cluster0@cluster0.qwg6bld.mongodb.net/?retryWrites=true&w=majority"; // Change the connection string as needed

    try {
        $client = new MongoDB\Client($connectionString);
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo "Error connecting to MongoDB: " . $e->getMessage();
        exit;
    }

    return $client;
}
?>