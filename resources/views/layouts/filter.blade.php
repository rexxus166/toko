<div class="w-full md:w-64 bg-white rounded-lg shadow-md p-6">
                <h2 class="font-poppins font-semibold text-lg mb-4">Categories</h2>
                <ul class="space-y-2">
                    <li>
                        <a href="#" onclick="filterByCategory('All')" class="flex items-center text-blue-600">
                            <i class="fas fa-angle-right mr-2"></i>
                            All Products
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="filterByCategory('Groceries')" class="flex items-center text-gray-600 hover:text-blue-600">
                            <i class="fas fa-angle-right mr-2"></i>
                            Groceries
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="filterByCategory('beverages')" class="flex items-center text-gray-600 hover:text-blue-600">
                            <i class="fas fa-angle-right mr-2"></i>
                            Beverages
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="filterByCategory('Snacks')" class="flex items-center text-gray-600 hover:text-blue-600">
                            <i class="fas fa-angle-right mr-2"></i>
                            Snacks
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="filterByCategory('household')" class="flex items-center text-gray-600 hover:text-blue-600">
                            <i class="fas fa-angle-right mr-2"></i>
                            Household
                        </a>
                    </li>
                </ul>

                <hr class="my-6">
            </div>

<script>
    // Filter products by category
    function filterByCategory(category) {
        const allProducts = document.querySelectorAll('.product-card');
        allProducts.forEach(product => {
            if (category === 'All' || product.classList.contains(category)) {
                product.classList.remove('hidden');
            } else {
                product.classList.add('hidden');
                }
            });
        }
</script>