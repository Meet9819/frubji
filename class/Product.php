<?php
class Product {
	private $host  = 'localhost';
    private $user  = 'root';
    private $password   = "";
    private $database  = "frubji";   
	private $productTable = 'products';
	private $dbConnect = false;



    public function __construct(){
        if(!$this->dbConnect){ 
            $conn = new mysqli($this->host, $this->user, $this->password, $this->database);
            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }




	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}






	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}		
	public function getBrand(){
		$sqlQuery = "
			SELECT DISTINCT(brand)
			FROM ".$this->productTable." 
			WHERE status = '1' ORDER BY id DESC";
        return  $this->getData($sqlQuery);
	} 




		////////////

	public function getnewold(){
		$sqlQuery = "
			SELECT DISTINCT(newold)
			FROM ".$this->productTable." 
			WHERE status = '1' ORDER BY newold ASC";
        return  $this->getData($sqlQuery);
	}

	////////////
	
	public function searchProducts(){
		$sqlQuery = "SELECT * FROM ".$this->productTable." WHERE status = '1'";
		if(isset($_POST["minPrice"], $_POST["maxPrice"]) && !empty($_POST["minPrice"]) && !empty($_POST["maxPrice"])){
			$sqlQuery .= "
			AND price BETWEEN '".$_POST["minPrice"]."' AND '".$_POST["maxPrice"]."'";
		}
		if(isset($_POST["brand"])) {
			$brandFilterData = implode("','", $_POST["brand"]);
			$sqlQuery .= "
			AND brand IN('".$brandFilterData."')";
		}
		
////////////
if(isset($_POST["newold"])){
			$ramFilterData = implode("','", $_POST["newold"]);
			$sqlQuery .= "
			AND newold IN('".$ramFilterData."')";
		}

////////////

		
		$sqlQuery .= " ORDER By price";
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		$totalResult = mysqli_num_rows($result);
		$searchResultHTML = '';
		if($totalResult > 0) {
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
				$searchResultHTML .= '
				 <div class="col-xs-12 col-sm-6 col-md-4 product">
							<div class="product-img">';





  $searchResultHTML .= ''; 
$img = $row['img'];

if ($img == '') { 
    $searchResultHTML .= '<img src="images/noimage.jpg"  >';} 

else{ 
     
     $searchResultHTML .= '   <img src="images/products/'.$row['img'].'" alt="'.$row['name'].'" title="'.$row['name'].'"/> '; 

} 
  $searchResultHTML .= '  </a>                '; 

 $searchResultHTML .= '



								<div class="product-hover">
									<div class="product-action">
									
									
									


										<a class="btn btn-primary" href="cartAction.php?action=addToCart&id='.$row['id'].'">Add To Cart</a>
										<a class="btn btn-primary" href="detailpage.php?q='.$row['id'].'">Item Details</a>
									</div>
								</div>
								
							</div>
						
							<div class="product-bio">
								<div class="prodcut-cat">
									<a href="detailpage.php?q='.$row['id'].'">'.$row['productcode'].' - '. $row['newold'] .'</a>
								</div>
							
								<div class="prodcut-title">
									<h3>
										<a href="detailpage.php?q='.$row['id'].'" style="
    text-transform: capitalize;font-size:16px"> '.substr($row['name'],0,30).'.. [ '. $row['brand'] .' ]</a> 

									</h3>
								</div>
								
								<div class="product-price">
									<span class="symbole">&#8377; </span><span>'. $row['price'] .'</span>
								</div>
							</div>
						</div> 


';
			}
		} else {
			$searchResultHTML = '<h3>No product found.</h3>';
		}
		return $searchResultHTML;	
	}	
}
?>