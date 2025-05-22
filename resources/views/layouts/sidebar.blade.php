<!-- Sidebar -->
<div id="sidebar" class="bg-blue-800 text-white w-64 py-6 flex flex-col">
    <div class="px-6 mb-8">
        <h1 class="font-poppins text-xl font-bold">Toko Desi</h1>
        <p class="text-blue-200 text-sm">Admin Dashboard</p>
    </div>

    <nav class="flex-1">
        <a href="{{ route('admin.dashboard') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.dashboard') ? 'bg-blue-900' : 'text-blue-100' }}">
            <i class="fas fa-tachometer-alt mr-3"></i>
            Dashboard
        </a>
        <a href="{{ route('admin.member') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.member') || request()->routeIs('admin.new-member') || request()->routeIs('admin.member.edit') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-users mr-3"></i>
            Kelola Member
        </a>
        <a href="{{ route('admin.supplier') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.supplier') || request()->routeIs('admin.new-supplier') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-truck mr-3"></i>
            Kelola Supplier
        </a>
        <a href="{{ route('admin.produk') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.produk') || request()->routeIs('admin.new-produk') || request()->routeIs('admin.produk.edit') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-box mr-3"></i>
            Kelola Produk
        </a>
        <a href="{{ route('admin.barang-masuk') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.barang-masuk') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-arrow-right mr-3"></i>
            Barang Masuk
        </a>
        <a href="{{ route('admin.barang-keluar') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.barang-keluar') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-arrow-left mr-3"></i>
            Barang Keluar
        </a>
        <a href="{{ route('admin.stok') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.stok') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-boxes mr-3"></i>
            Stok Produk
        </a>
        <a href="{{ route('admin.transaksi') }}" 
           class="flex items-center px-6 py-3 {{ request()->routeIs('admin.transaksi') ? 'bg-blue-900' : 'text-blue-100 hover:bg-blue-700' }}">
            <i class="fas fa-exchange-alt mr-3"></i>
            Transaksi
        </a>
    </nav>

    <div class="px-6 py-4 border-t border-blue-700">
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center text-blue-100 hover:text-white">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </button>
        </form>
    </div>
</div>

<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');
        const overlay = document.getElementById('overlay');
        
        sidebar.classList.toggle('sidebar-hidden');
        mainContent.classList.toggle('sidebar-hidden');
        overlay.classList.toggle('active');
    }
</script>