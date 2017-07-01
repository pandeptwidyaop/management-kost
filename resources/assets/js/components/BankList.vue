<template lang="html">
  <div class="col-md-4">
    <div class="thumbnail">
      <div class="caption text-center">
        <h3 align="center">Bank {{bank.bank}}</h3>
        <h5>Nomor Rekening : {{bank.number}}</h5>
        <small> AN : {{bank.name}}</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ['bank']
}
</script>

<style lang="css">
</style>
