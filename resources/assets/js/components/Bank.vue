<template>
  <div class="row">
      <div class="col-md-8 col-md-offset-2">
          <div class="panel panel-default">
              <div class="panel-heading">Pembayaran Tagihan</div>
              <div class="panel-body">
                <div class="text-center">
                  <p>  Silakan transfer tepat <h1> Rp. {{total}}</h1> ke salah satu rekening di bawah ini, pastikan anda menyimpan bukti pembayarannya dan sertakan pada saat konformasi pembayaran.</p>
                </div>
                <div class="row">
                  <bank-list v-for="bank in banks" :key="bank.number" :bank="bank"></bank-list>
                </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
export default {
  props : ['banks','total']
}
</script>

<style lang="css">
  .panel{
    margin-top: 100px;
  }
</style>
