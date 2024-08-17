<?php
include "header.php";
require_once '../Database.php';
if (!isset($_SESSION['email'])) {
    header("Location: /urlShortener/src/views/signin.php");
}

if(isset($_POST['submit'])){


    $url = $_POST['url'];

    $db = new Database();

    $sql = 'SELECT shortenID FROM urls WHERE originalUrl = ? AND userEmail = ?';
    $result = $db->prepare($sql,['ss',$url,$_SESSION['email']]);

    if($result->num_rows < 1){
        while(true){
            $id = substr(uniqid(),-6);

            $sql = 'SELECT * FROM urls WHERE shortenID = ?';
            $result = $db->prepare($sql,['s',$id]);

            if($result->num_rows < 1){
                if(isset($_SESSION['email'])){
                    $email = $_SESSION['email'];
                    $sql = "INSERT INTO urls(originalURL,shortenID,userEmail) VALUES (?,?,?)";
                    $query = $db->prepare($sql, ['sss' ,$url,$id,$email]);
                }else{
                    $sql = "INSERT INTO urls(originalURL,shortenID) VALUES (?,?)";
                    $query = $db->prepare($sql, ['sss' ,$url,$id]);
                }
                if($query ){
                    echo 'error happened while creating record: '. $query;
                }else{
                    echo 'record created successfully';
                }
                break;
            }else continue;
        }
    }else{
        echo 'URL is already shortened<br>';
    }

}


?>

<body class="flex flex-col min-h-screen">
    <div class="flex flex-col flex-grow">
        <form class="flex items-center justify-center p-10" method="POST" action="shortener.php">
            <!-- Text Input -->
            <input type="text" placeholder="Enter your URL" name="url"
                class="px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">

            <!-- Button -->
            <button
                class="px-4 py-2 text-white bg-blue-500 rounded-r-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500" name="submit" type="submit">
                Shorten
            </button>
        </form>
        <div class="container mx-auto">
            <table class="min-w-full bg-white border border-gray-200">
                <thead class="bg-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Original url</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            shortened url</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            clicks</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                            Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                       

                        $db = new Database();
                        $sql = "SELECT * FROM urls WHERE userEmail = ?";
                        $result = $db->prepare($sql,['s',$_SESSION['email']]);
                        
                        
                        if ($result) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                            <tr class="border-b border-gray-200">
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['originalUrl']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap"> 
                                    <a href="http://localhost/urlShortener/<?php echo htmlspecialchars($row['shortenID']); ?>">
                                    http://localhost/urlShortener/<?php echo basename(__DIR__).htmlspecialchars($row['shortenID']); ?>
                                    </a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap"><?php echo htmlspecialchars($row['clicks']); ?></td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <button
                                        class="px-4 py-2 text-white bg-blue-500 rounded hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Edit</button>
                                </td>
                            </tr>
                    <?php
                        }
                        $db->close();
                    } else {
                        echo "<tr><td colspan='4' class='text-center text-red-500'>No URLs found please add some URLs to be shorten</td></tr>";
                        $db->close();
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
<?php
include "footer.php";
?>