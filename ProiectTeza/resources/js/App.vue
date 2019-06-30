<template>
  <ais-instant-search
    :search-client="searchClient"
    index-name="clients"
    style="min-height:61.59px; 
          "
  >
  <!-- <ais-configure -->
  <!-- :hits-per-page.camel="4" -->
<!-- /> -->

    <ais-stats />
    <ais-search-box placeholder="Search for clients..." submit-title="Submit the query" reset-title="Remove the query"   autofocus/>
    <ais-state-results>
      <template slot-scope="{ query }">
        <ais-hits v-if="query.length > 0">
          <div slot="item" slot-scope="{ item, index }">
            <a v-bind:href="'/bookings/'+ item.id +'/show'">
              <!-- <ais-highlight attribute="First_Name" :hit="item" /> -->
              <ais-highlight attribute="Status" :hit="item" />
              <ais-highlight attribute="Last_Name" :hit="item" /> <br>
              <ais-highlight attribute="Phone" :hit="item" /><br>
              <ais-highlight attribute="Checkin" :hit="item" />
              <ais-highlight attribute="Checkout" :hit="item" />
          </a>

          </div>
        </ais-hits>
      </template>
    </ais-state-results>
    <!-- <ais-pagination /> -->
  </ais-instant-search> 
</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
  data() {
    return {
      searchClient: algoliasearch(
        'RHMF511X4B',
        '69053ca492a1c289ce82b294c065d268'
      )
    };
  }
};

</script>


<style scoped lang="scss">

.ais-Hits *:hover{
  color: #4e5d97;
}
</style>