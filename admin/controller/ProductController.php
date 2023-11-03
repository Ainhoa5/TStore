<?php 

class ProductController {
    private $productModel;

    public function __construct(Product $productModel) {
        $this->productModel = $productModel;
    }

    public function showProducts() {
        $products = $this->productModel->getProducts();
        include 'views/products_view.php';
    }
    public function createProduct() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate the input...
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);
            // ...other fields

            // Further validation like checking for empty strings, 
            // proper formats, etc. would also take place here.
            $isValid = true;
            
            // If the data is valid, call the model to insert the product
            if ($isValid) {
                $this->productModel->createProduct([
                    'name' => $name,
                    'description' => $description,
                    // ...other fields
                ]);
                // Redirect to a success page or display a success message
            } else {
                // Handle errors, possibly re-display the form with validation messages
            }
        }
    }
}
?>
