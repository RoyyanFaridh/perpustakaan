<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-md text-gray-500 leading-tight">
            <?php echo e(__('> Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-4">
        <div class="mx-auto sm:px-4 lg:px-6">
            <div class="font-bold text-3xl text-gray-900 mb-4">
                <?php echo e(__("Statistik Pengunjung")); ?>

            </div>
    
            <!-- Wrapper untuk Card -->
            <div class="d-flex mb-4" style="display: flex; gap: 20px; justify-content: space-between;">
                <!-- Card 1: Total Koleksi Buku -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Koleksi Buku</h5>
                        <p class="card-text"><?php echo e($totalKoleksiBuku); ?></p>
                    </div>
                </div>
    
                <!-- Card 2: Total Anggota -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Anggota</h5>
                        <p class="card-text"><?php echo e($totalAnggota); ?></p>
                    </div>
                </div>
    
                <!-- Card 3: Total Peminjaman Buku -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Peminjaman Buku</h5>
                        <p class="card-text"><?php echo e($totalPeminjamanBuku); ?></p>
                    </div>
                </div>
    
                <!-- Card 4: Total Keterlambatan Pengembalian -->
                <div class="card border border-gray-300 shadow-sm" style="flex: 1 1 23%; box-sizing: border-box;">
                    <div class="card-body">
                        <h5 class="card-title">Total Keterlambatan Pengembalian Buku</h5>
                        <p class="card-text"><?php echo e($totalKeterlambatanPengembalian); ?></p>
                    </div>
                </div>
            </div>
        </div>
    
        
        <div class="bg-white p-6 rounded shadow">
            <canvas id="statistikChart" height="100"></canvas>
        </div>
    </div>
    
    <script>
        const ctx = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,  // Menampilkan bulan (format: YYYY-MM)
                datasets: [{
                    label: 'Jumlah Pengunjung',
                    data: <?php echo json_encode($jumlahPengunjung, 15, 512) ?>,  // Menampilkan jumlah pengunjung per bulan
                    backgroundColor: '#4B5563',
                    borderRadius: 6,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\Users\ASUS\perpustakaan_smp\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>