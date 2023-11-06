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
    public function createProduct($data)
    {
        $validation = $this->validateAndSanitizeProductData($data);

        if (count($validation['errors']) > 0) {
            return $validation['errors'];
        }

        $result = $this->productModel->createProduct($validation['data']);
        header('Location: ../../admin/index.php?message=');
        exit();
    }

    public function updateProduct($data)
    {
        $validation = $this->validateAndSanitizeProductData($data);

        if (count($validation['errors']) > 0) {
            return $validation['errors'];
        }

        $validation['data']['ProductoID'] = $data['ProductoID']; // Add the ProductID for update

        $result = $this->productModel->update($validation['data']);
        header('Location: ../../admin/index.php?message=');
        exit();
    }



    private function validateAndSanitizeProductData($data)
    {
        $errors = [];
        $sanitizedData = [];

        // Helper function to check if a string is essentially empty
        $isEssentiallyEmpty = function ($str) {
            return strlen(trim($str)) == 0;
        };

        // Validation and Sanitization for each field
        foreach (['name', 'description', 'category'] as $field) {
            if (empty($data[$field]) || $isEssentiallyEmpty($data[$field])) {
                $errors[$field] = ucfirst($field) . ' is required and cannot be blank';
            } else {
                $sanitizedData[$field] = filter_var($data[$field], FILTER_SANITIZE_STRING);
            }
        }

        // Price validation
        if (!is_numeric($data['price']) || $data['price'] < 0) {
            $errors['price'] = 'Invalid price';
        } else {
            $sanitizedData['price'] = $data['price'];
        }

        // Stock validation
        if (!is_numeric($data['stock']) || $data['stock'] < 0 || intval($data['stock']) != $data['stock']) {
            $errors['stock'] = 'Invalid stock value';
        } else {
            $sanitizedData['stock'] = intval($data['stock']);
        }

        return ['errors' => $errors, 'data' => $sanitizedData];
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
