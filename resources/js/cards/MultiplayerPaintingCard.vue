<template>
  <Card 
      :classes="cardClasses"
      poster="/storage/multiplayer-painting-poster.jpg"
      :tags="['C#', 'Unity', 'Networked Multiplayer', 'XR Interaction Toolkit', 'Photon PUN2']" 
      vidSrc="https://kmw-bitmovin.s3.amazonaws.com/multiplayer-painting-final/manifest.m3u8">
      <template v-slot:headline> AR Multiplayer Painting </template>
      <template v-slot:secondary-headline></template>
      <template v-slot:paragraph>
        Developed a unique local multiplayer solution for Quest 2 and subsequent headsets, allowing multiple users to collaboratively spray paint a shared object in the same physical environment. Utilized passthrough AR on Quest 2 and integrated Photon PUN2 for synchronization. Anticipating an enhancement in 2023 with the integration of Shared Spatial Anchors.
      </template>
  </Card>
</template>

<script>
import Card from '../components/card.vue';

export default {
  components: {
      Card
  },
  props: {
      additionalClasses: {
          type: String,
          default: ''
      }
  },
  computed: {
      cardClasses() {
          return `duration-1000 transition data-inviewport sm:opacity-100 ${this.additionalClasses}`;
      }
  }
};
</script>
