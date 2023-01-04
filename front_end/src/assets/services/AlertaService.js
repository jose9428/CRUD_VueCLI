import { createToaster } from "@meforma/vue-toaster";

 const  toaster = createToaster({ duration: 5000,
                                    position: 'top-right', // ['top-right', 'top-center', 'top-left', 'bottom-right', 'bottom-center', 'bottom-left']
                                    theme: 'outline', // ['toasted-primary', 'outline', 'bubble']
                                    iconPack: 'material' // ['material', 'fontawesome', 'mdi', 'custom-class', 'callback']
                                });

export function success(msg){
    toaster.success(msg);
}

export function error(msg){
    toaster.error(msg);
}

export function info(msg){
    toaster.info(msg);
}

export function warning(msg){
    toaster.warning(msg);
}

export function show(msg){
    toaster.show(msg);
}
