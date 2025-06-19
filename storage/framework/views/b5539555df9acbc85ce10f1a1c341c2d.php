<div class="py-4 px-4 lg:px-6 w-full">
    <h2 class="text-xl font-semibold text-gray-800 mb-4">Dashboard</h2>

    <!-- Card Summary -->
    <div class="flex flex-wrap gap-4 mb-4">
        <!--[if BLOCK]><![endif]--><?php $__currentLoopData = $cardData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => ['title' => $card['title'],'bgColor' => $card['bgColor'],'value' => $card['value'],'periode' => $card['periode'],'delta' => $card['delta'],'icon' => $card['icon']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['title']),'bgColor' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['bgColor']),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['value']),'periode' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['periode']),'delta' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['delta']),'icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($card['icon'])]); ?>
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
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><!--[if ENDBLOCK]><![endif]-->
    </div>

        <div class="bg-white p-4 rounded shadow">
            <h3 class="font-semibold text-gray-800 text-base mb-3">Statistik Pengunjung</h3>
            <div class="relative" style="height: 14rem;">
                <canvas id="chartKunjungan" class="absolute inset-0 w-full h-full"></canvas>
            </div>
        </div>

</div>


<script>
    const chartBaseOptions = (title) => ({
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'bottom',
                labels: {
                    color: '#374151',
                    font: { weight: 'bold' }
                }
            },
            tooltip: {
                mode: 'index',
                intersect: false
            },
            title: {
                display: false
            }
        },
        interaction: {
            mode: 'nearest',
            intersect: false
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { color: '#6B7280' },
                grid: { color: '#E5E7EB' }
            },
            x: {
                ticks: { color: '#6B7280' },
                grid: { display: false }
            }
        }
    });

    // Chart Kunjungan
    new Chart(document.getElementById('chartKunjungan').getContext('2d'), {
        type: 'line',
        data: {
            labels: <?php echo json_encode($bulanLabels, 15, 512) ?>,
            datasets: [
                {
                    label: '<?php echo e($tahunSebelumnya); ?>',
                    data: <?php echo json_encode($jumlahPengunjungTahunLalu, 15, 512) ?>,
                    borderColor: '#60A5FA',
                    backgroundColor: 'rgba(96, 165, 250, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 3,
                    tension: 0.4
                },
                {
                    label: '<?php echo e($tahunSekarang); ?>',
                    data: <?php echo json_encode($jumlahPengunjungTahunIni, 15, 512) ?>,
                    borderColor: '#FB7185',
                    backgroundColor: 'rgba(251, 113, 133, 0.2)',
                    borderWidth: 2,
                    fill: true,
                    pointRadius: 3,
                    tension: 0.4
                }
            ]
        },
        options: chartBaseOptions('Statistik Kunjungan')
    });
</script><?php /**PATH C:\Users\ACER\perpustakaan\resources\views/livewire/user/dashboard/index.blade.php ENDPATH**/ ?>