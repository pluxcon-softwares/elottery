<template>
<div>
<div class="wrapper">

  <!-- Navbar -->
  <Navbar />
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <Sidebar />

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 541px;">
    <!-- Content Header (Page header) -->

    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <router-view></router-view>
        </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
  <!-- /.content-wrapper -->

<!-- Footer -->
<Footer />

</div>

</template>

<script>
import Sidebar from './layout/Sidebar.vue';
import Navbar from './layout/Navbar.vue';
import Footer from './layout/Footer.vue';
export default {
    components:{
        Sidebar,
        Navbar,
        Footer
    },
    data(){
        return{}
    },
    methods:{},
}
</script>
