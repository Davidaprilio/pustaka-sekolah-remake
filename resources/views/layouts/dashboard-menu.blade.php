<div class="mt-4">
    <x-sidebar-menu :link="url('dashboard')" name="Dashboard" icon="fa fa-dashboard" />
    <x-sidebar-menu :link="route('task.list')" name="Penugasan" icon="fa fa-book" />
    <x-sidebar-menu :link="url('books')" name="Buku" icon="fa fa-book" />
    <x-sidebar-menu :link="route('etalase.index')" name="Ketegori" icon="fa fa-book" />
</div>