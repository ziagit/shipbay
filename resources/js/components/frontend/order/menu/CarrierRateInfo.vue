<template>
  <div class="info">
    <div class="content">
      <div class="md-body-2">Price breakdown</div>
      <div class="md-body-1">
        <span>Line Haul:</span>
        <span>$196</span>
      </div>
      <div class="md-body-1">
        <span>Fuel Surcharge:</span>
        <span>$19</span>
      </div><br>
      <md-divider></md-divider>
      <p
        class="details"
      >Carrier liability for loss or damage to cargo is $10.00 per pound for new items (or $0.10 per pound for used items) or a maximum of $100,000.00 per shipment (whichever is lower).</p>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style lang="scss" scoped>
.info {
  min-width: 100%;
  min-height: 100%;
  .content {
    padding: 20px;
    .md-body-1{
        display: flex;
        justify-content: space-between;
    }
    .details {
      white-space: initial;
    }
  }
}
</style>