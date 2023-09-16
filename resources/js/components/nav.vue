<template>
<nav ref="nav" :class="['safe-area-padding z-[101] flex flex-col sm:flex-row gap-y-2 mb-16 justify-between duration-[2000ms]', additionalClasses]">
     <div class="flex items-center">
         <router-link to="/" class="flex ml-2 text-gray-400 items-center">
             <div class="text-shadow ml-2 text-xl font-bold"><!-- text-sky-400 -->
                A.L. 
             </div>
         </router-link>
     </div>
     <ul class="flex flex-wrap gap-x-3 font-medium text-gray-300 pl-5 justify-left">
         <li class="hover:text-white">
             <router-link class="text-shadow ml-2 mr-2" to="/resume">Résumé</router-link>
         </li>
         <li class="hover:text-white">
             <a class="text-shadow ml-2 mr-2 " href="https://www.linkedin.com/in/andrew-laboy-b4a169138/">LinkedIn</a>
         </li>
     </ul>
 </nav>
  </template>
  
  <script>

import { ref } from 'vue'
import { onMounted, onUnmounted } from '@vue/runtime-core'

  export default {
    setup() {
    }, 
    props: {
        additionalClasses: {
            type: String,
            default: ''
        }
    },
    
  };
  </script>