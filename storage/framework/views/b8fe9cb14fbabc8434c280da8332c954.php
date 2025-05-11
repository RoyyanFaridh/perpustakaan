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
                <!-- Wrapper untuk Card -->
            <div class="flex flex-wrap gap-4 mb-4">
                <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Total Koleksi Buku','bgColor' => '#ED5565','value' => number_format($totalKoleksiBuku, 0, ',', '.'),'periode' => 'Maret 2025','delta' => 8,'icon' => view('components.icon.books')->render()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Total Koleksi Buku','bgColor' => '#ED5565','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($totalKoleksiBuku, 0, ',', '.')),'periode' => 'Maret 2025','delta' => 8,'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(view('components.icon.books')->render())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>


                <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Total Anggota','bgColor' => '#1C84C6','value' => number_format($totalAnggota, 0, ',', '.'),'periode' => 'Maret 2025','delta' => 8,'icon' => view('components.icon.users')->render()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Total Anggota','bgColor' => '#1C84C6','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($totalAnggota, 0, ',', '.')),'periode' => 'Maret 2025','delta' => 8,'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(view('components.icon.users')->render())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Total Peminjaman','bgColor' => '#23C6C8','value' => number_format($totalPeminjaman, 0, ',', '.'),'periode' => 'Maret 2025','delta' => 8,'icon' => view('components.icon.calendar-clock')->render()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Total Peminjaman','bgColor' => '#23C6C8','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($totalPeminjaman, 0, ',', '.')),'periode' => 'Maret 2025','delta' => 8,'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(view('components.icon.calendar-clock')->render())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => 'Total Keterlambatan','bgColor' => '#1AB394','value' => number_format($totalKeterlambatan, 0, ',', '.'),'periode' => 'Maret 2025','delta' => 8,'icon' => view('components.icon.calendar-x-2')->render()]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Total Keterlambatan','bgColor' => '#1AB394','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(number_format($totalKeterlambatan, 0, ',', '.')),'periode' => 'Maret 2025','delta' => 8,'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(view('components.icon.calendar-x-2')->render())]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
            </div>
            
        </div>

        <div class="font-bold text-3xl text-gray-900 mb-4 ml-4">
            <?php echo e(__("Statistik Pengunjung")); ?>

        </div>
        
        <div class="bg-white p-6 rounded shadow">
            <canvas id="statistikChart" height="100"></canvas>
        </div>
    </div>
    
    <script>
        const ctx = document.getElementById('statistikChart').getContext('2d');
        const statistikChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,
                datasets: [
                    {
                        label: '<?php echo e($tahunSebelumnya); ?>',
                        data: <?php echo json_encode($jumlahPengunjungTahunLalu, 15, 512) ?>,
                        borderColor: '#60A5FA', // biru muda
                        backgroundColor: 'rgba(96, 165, 250, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        pointRadius: 4,
                        tension: 0.4
                    },
                    {
                        label: '<?php echo e($tahunSekarang); ?>',
                        data: <?php echo json_encode($jumlahPengunjungTahunIni, 15, 512) ?>,
                        borderColor: '#FB7185', // merah muda
                        backgroundColor: 'rgba(251, 113, 133, 0.2)',
                        borderWidth: 2,
                        fill: true,
                        pointRadius: 4,
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#374151',
                            font: {
                                weight: 'bold'
                            }
                        }
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                interaction: {
                    mode: 'nearest',
                    intersect: false
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#6B7280'
                        },
                        grid: {
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        ticks: {
                            color: '#6B7280'
                        },
                        grid: {
                            display: false
                        }
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