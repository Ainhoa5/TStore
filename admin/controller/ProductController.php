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
    public function createProduct($data) // TO DO
    {
        // Validate and sanitize $data
        $productName = $data['name'];
        $productDescription = $data['description'];
        $productPrice = $data['price'];
        $productStock = $data['stock'];
        $productcategory = $data['category'];
        echo $productName.' '.$productDescription.' '.$productPrice.' '.$productStock.' '.$productcategory;

        // Create the product using the model
        $result = $this->productModel->createProduct($data);

        // Redirect to the product list with a success/failure message
        /* header('Location: ../../admin/index.php?message=' . urlencode($result ? 'Update successful' : 'Update failed')); */
        exit();
    }

    public function updateProduct($data) // TO DO
    {
        // Validate and sanitize $data
        $productName = $data['name'];
        $productDescription = $data['description'];
        $productPrice = $data['price'];
        $productStock = $data['stock'];
        $productcategory = $data['category'];
        /* echo $productName.' '.$productDescription.' '.$productPrice.' '.$productStock.' '.$productcategory; */

        // Update the product using the model
        $result = $this->productModel->update($data);

        // Redirect to the product list with a success/failure message
        /* header('Location: ../../admin/index.php?message=' . urlencode($result ? 'Update successful' : 'Update failed')); */
        exit();
    }
    public function showUpdateForm($productId)
    {

        $product = $this->productModel->findById($productId);
        include '../../admin/view/update_product_form.php'; // path to your update form view
    }
    public function deleteProduct($id)
    {
        $this->productModel->deleteProduct($id);

        // Redirect to prevent resubmission
        header('Location: ../../admin/index.php');
        exit();
    }
}
