<!-- resources/views/components/income-card.blade.php -->
<div class="border rounded shadow p-4">
    <ul class="flex border-b">
        <li class="-mb-px mr-1">
            <a
                class="cursor-pointer bg-white inline-block py-2 px-4 text-purple-500 font-semibold"
                onclick="toggleTab('daily')"
            >
                Diario
            </a>
        </li>
        <li class="mr-1">
            <a
                class="cursor-pointer bg-white inline-block py-2 px-4 text-purple-500 font-semibold"
                onclick="toggleTab('weekly')"
            >
                Semanal
            </a>
        </li>
        <li class="mr-1">
            <a
                class="cursor-pointer bg-white inline-block py-2 px-4 text-purple-500 font-semibold"
                onclick="toggleTab('monthly')"
            >
                Mensual
            </a>
        </li>
        <li>
            <a
                class="cursor-pointer bg-white inline-block py-2 px-4 text-purple-500 font-semibold"
                onclick="toggleTab('yearly')"
            >
                Anual
            </a>
        </li>
    </ul>
    <div id="daily" class="p-4">
        <!-- Contenido para ingresos diarios -->
        <p>$ 50, 000</p>
    </div>
    <div id="weekly" class="hidden p-4">
        <!-- Contenido para ingresos semanales -->
        <p>$ 500, 000</p>
    </div>
    <div id="monthly" class="hidden p-4">
        <!-- Contenido para ingresos mensuales -->
        <p>$ 5000, 000</p>
    </div>
    <div id="yearly" class="hidden p-4">
        <!-- Contenido para ingresos anuales -->
        <p>$ 500000, 000</p>
    </div>
</div>

<script>
    function toggleTab(tabId) {
        const tabs = ['daily', 'weekly', 'monthly', 'yearly'];
        tabs.forEach(tab => {
            if (tab === tabId) {
                document.getElementById(tab).classList.remove('hidden');
            } else {
                document.getElementById(tab).classList.add('hidden');
            }
        });
    }
</script>
