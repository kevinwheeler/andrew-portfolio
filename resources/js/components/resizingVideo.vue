<template>
   <video :style="videoStyles" autoplay loop muted playsinline class="shadow-none -mt-2 py-2">
     <source :src="`${src}`" :type="`${type}`"/>
     Your browser does not support the video tag.
   </video>
 </template>
  
  <script>
import { ref, onMounted, onUnmounted, watch } from 'vue';

export default {
  name: 'FullScreenVideo',
  props: {
    'aspectRatio': {
      type: Number,
      required: true,
    },
    'type': {
      type: String,
      required: true,
    },
    'src': {
      type: String,
      required: true,
    },
  },
  setup() {
    const videoAspectRatio = ref(16/9);
    const videoStyles = ref({});

    const adjustVideoSize = () => {
      const viewportAspectRatio = window.innerWidth / window.innerHeight;

      // viewport is wider than video
      if (viewportAspectRatio > videoAspectRatio.value) {
        videoStyles.value = {
          height: '100vh',
          width: 'auto',
        };
      // viewport is taller than video
      } else {
        videoStyles.value = {
          width: '100vw',
          height: 'auto',
        };
      }
    };

    const resizeListener = () => adjustVideoSize();

    onMounted(() => {
      window.addEventListener('resize', resizeListener);
      adjustVideoSize();
    });

    onUnmounted(() => {
      window.removeEventListener('resize', resizeListener);
    });

    return {
      videoStyles,
    };
  },
};
</script>