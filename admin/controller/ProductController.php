<?php

class ProductController
{
    private $productModel;

    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    public function showProducts()
    {
        return $this->productModel->getProducts();
    }
    public function createProduct()
    {
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

    public function updateProduct($data) {
        // Validate and sanitize $data
        // ...
    
        // Update the product using the model
        $result = $this->productModel->update($data);
    
        // Redirect to the product list with a success/failure message
        header('Location: product_view.php?message=' . urlencode($result ? 'Update successful' : 'Update failed'));
        exit();
    }
    public function showUpdateForm($productId) {
        $product = $this->productModel->findById($productId);
        include 'update_product_form.php'; // path to your update form view
    }
    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);

        // Redirect to prevent resubmission
        header('Location: ../../admin/view/product_view.php');
        exit();
    }
}
?>