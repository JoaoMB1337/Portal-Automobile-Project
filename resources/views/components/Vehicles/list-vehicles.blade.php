@vite(['resources/js/Geral/list.js'])

<div class="container">
    @if (session('message'))
        <div class="alert alert-info">
            {{ session('message') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
    <div class="p-4 md:p-6 rounded-lg shadow-md mb-3 bg-gradient-to-r from-gray-100 via-gray-200 to-gray-300">
        <div class="flex flex-col md:flex-row items-center justify-between mb-4 md:mb-6">
            <div class="flex items-center space-x-2 md:space-x-4 mb-4 md:mb-0">

                <svg class="w-16 h-16 text-gray-700" viewBox="0 -111.5 1202 1202" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <g filter="url(#filter0_f_3_320)">
                            <path
                                d="M888.01 718.838C931.233 705.128 1009.76 668.215 1037.79 641.313C1070.15 613.113 1001.79 583.016 993.669 578.451C985.544 573.885 586.745 382.929 517.241 353.484C447.737 324.04 229.877 391.225 177.317 421.372C134.474 445.945 165.221 462.478 171.043 467.075C176.865 471.673 509.348 651 628.718 705.484C719.117 746.744 803.167 745.751 888.01 718.838Z"
                                fill="#000000" fill-opacity="0.2"></path>
                        </g>
                        <path
                            d="M676.453 516.424C675.768 514.779 629.175 507.566 605.965 504.165C597.517 511.454 580.303 526.78 579.021 529.777C577.418 533.523 579.481 562.868 597.976 584.125C616.472 605.381 656.552 572.553 669.303 567.411C682.054 562.27 677.309 518.481 676.453 516.424Z"
                            fill="#2C2C2C"></path>
                        <path
                            d="M338.338 354.782C337.653 353.136 291.06 345.924 267.849 342.523C259.402 349.811 242.188 365.138 240.906 368.135C239.303 371.88 241.366 401.226 259.861 422.482C278.357 443.739 318.436 410.911 331.188 405.769C343.939 400.627 339.194 356.839 338.338 354.782Z"
                            fill="#131313"></path>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M612.743 532.197L656.276 511.264L656.285 511.283C656.554 511.149 656.825 511.018 657.098 510.89C683.035 498.812 720.638 524.836 741.086 569.015C761.534 613.195 757.085 658.801 731.148 670.879C730.828 671.028 730.506 671.171 730.182 671.308L688.126 691.559L664.024 640.606C657.706 632.494 651.961 623.124 647.161 612.754C642.732 603.186 639.472 593.551 637.344 584.205L612.743 532.197Z"
                            fill="#000000"></path>
                        <ellipse rx="51.8273" ry="88.04"
                            transform="matrix(-0.906138 0.421956 0.420223 0.907898 651.003 611.688)" fill="#000000">
                        </ellipse>
                        <g filter="url(#filter1_i_3_320)">
                            <ellipse rx="38.8723" ry="66.0331"
                                transform="matrix(-0.906138 0.421956 0.420223 0.907898 649.515 611.755)"
                                fill="url(#paint0_linear_3_320)"></ellipse>
                        </g>
                        <g filter="url(#filter2_di_3_320)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M650.597 564.805C656.178 568.036 661.701 572.827 666.716 578.868L655.662 598.706C654.188 597.026 652.614 595.622 651.01 594.541L650.597 564.805ZM651.524 631.462C653.84 632.299 656.107 632.386 658.108 631.573L675.089 660.15C674.282 660.686 673.434 661.163 672.545 661.577C666.394 664.441 659.192 663.87 651.928 660.548L651.524 631.462ZM649.453 659.312L649.05 630.295C647.135 629.182 645.238 627.597 643.48 625.621L632.63 645.093C637.869 651.308 643.645 656.164 649.453 659.312ZM648.533 593.143L648.121 563.477C640.493 559.706 632.88 558.929 626.425 561.935C624.625 562.773 622.991 563.87 621.525 565.196L638.654 594.021C639.223 593.506 639.857 593.08 640.556 592.755C642.936 591.647 645.722 591.864 648.533 593.143ZM620.213 625.387C623.264 631.978 626.928 637.919 630.959 643.041L641.809 623.568C640.444 621.736 639.2 619.657 638.146 617.378C638.044 617.158 637.944 616.938 637.847 616.717L618.778 622.128C619.233 623.215 619.711 624.301 620.213 625.387ZM657.324 600.776L668.377 580.939C672.264 585.953 675.799 591.734 678.757 598.125C679.364 599.437 679.936 600.751 680.473 602.065L661.195 607.535C661.088 607.289 660.978 607.044 660.864 606.799C659.841 604.589 658.641 602.567 657.324 600.776ZM617.854 619.832C614.316 610.69 612.471 601.611 612.244 593.391L635.119 606.218C635.319 608.818 635.917 611.604 636.93 614.42L617.854 619.832ZM662.107 609.834C663.314 613.215 663.925 616.55 663.964 619.571L686.748 632.347C686.819 623.758 685.06 614.109 681.378 604.366L662.107 609.834ZM686.66 635.118L663.833 622.319C663.447 625.734 662.222 628.554 660.205 630.289L677.061 658.654C682.834 653.685 686.091 645.262 686.66 635.118ZM612.229 590.563L635.062 603.365C635.177 600.51 635.832 597.989 637.001 596.053L619.745 567.013C614.96 572.503 612.408 580.83 612.229 590.563Z"
                                fill="#4C4C4C"></path>
                        </g>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M612.754 531.274L656.288 510.342L656.292 510.351C656.564 510.214 656.838 510.082 657.114 509.953C683.051 497.875 720.653 523.898 741.101 568.078C761.549 612.258 757.1 657.864 731.163 669.942C730.922 670.054 730.68 670.163 730.436 670.269L688.137 690.636L664.013 639.636C657.705 631.532 651.969 622.173 647.176 611.817C642.755 602.264 639.497 592.644 637.37 583.312L612.754 531.274Z"
                            fill="#000000"></path>
                        <path
                            d="M603.966 634.424C624.161 678.055 661.241 703.782 686.786 691.887C712.332 679.991 716.669 634.977 696.474 591.346C676.279 547.714 638.059 519.639 612.514 531.535C586.968 543.43 583.771 590.792 603.966 634.424Z"
                            fill="#000000"></path>
                        <g filter="url(#filter3_i_3_320)">
                            <ellipse rx="36.4324" ry="63.679"
                                transform="matrix(-0.901928 0.432052 0.407225 0.913305 649.954 611.746)"
                                fill="url(#paint1_linear_3_320)"></ellipse>
                        </g>
                        <g filter="url(#filter4_di_3_320)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M627.264 626.823C637.107 646.418 652.972 658.431 665.361 656.01L655.184 633.614C650.05 633.197 644.202 628.545 639.996 621.358L627.264 626.823ZM624.244 620.078C616.254 599.89 617.484 579.808 626.859 571.284L637.035 593.677C634.041 598.301 633.882 606.386 636.867 614.66L624.244 620.078ZM661.098 604.26C656.514 595.14 649.278 589.362 643.352 589.785L633.312 567.691C646.322 564.062 663.681 577.252 673.721 598.842L661.098 604.26ZM663.806 611.139L676.538 605.674C683.781 625.74 681.935 645.262 672.057 652.953L662.015 630.855C665.466 626.897 666.162 619.266 663.806 611.139Z"
                                fill="#474747"></path>
                        </g>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M282.04 375.277L321.886 364.379L321.89 364.397C322.148 364.321 322.406 364.25 322.667 364.182C346.346 358.02 373.979 385.714 384.386 426.038C394.794 466.362 384.036 504.046 360.356 510.208C360.062 510.285 359.767 510.356 359.472 510.422L320.947 520.981L308.469 474.252C304.433 466.487 301.066 457.764 298.637 448.353C296.397 439.674 295.137 431.118 294.776 422.972L282.04 375.277Z"
                            fill="#000000"></path>
                        <ellipse rx="44.3326" ry="75.2964"
                            transform="matrix(-0.96712 0.251671 0.250086 0.968914 301.976 448.052)" fill="#000000">
                        </ellipse>
                        <g filter="url(#filter5_i_3_320)">
                            <ellipse rx="33.251" ry="56.475"
                                transform="matrix(-0.96712 0.251671 0.250086 0.968914 300.715 447.877)"
                                fill="url(#paint2_linear_3_320)"></ellipse>
                        </g>
                        <g filter="url(#filter6_di_3_320)">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M308.823 408.53C313.027 412.109 316.942 416.995 320.235 422.857L307.874 437.856C306.891 436.21 305.78 434.782 304.594 433.623L308.823 408.53ZM299.346 464.768C301.174 465.834 303.075 466.255 304.89 465.873L314.782 492.539C314.019 492.866 313.232 493.137 312.419 493.349C306.798 494.811 300.82 493.215 295.214 489.291L299.346 464.768ZM293.323 487.868L297.445 463.405C296.007 462.176 294.657 460.553 293.483 458.624L281.371 473.319C284.818 479.351 288.926 484.324 293.323 487.868ZM302.725 432.065L306.944 407.032C301.111 402.693 294.832 400.87 288.945 402.402C287.302 402.829 285.76 403.5 284.323 404.389L294.295 431.269C294.848 430.928 295.441 430.672 296.073 430.507C298.246 429.942 300.557 430.554 302.725 432.065ZM273.958 454.829C275.51 460.843 277.678 466.406 280.28 471.335L292.392 456.64C291.523 454.885 290.794 452.939 290.256 450.855C290.204 450.654 290.155 450.453 290.107 450.253L273.252 451.863C273.467 452.848 273.702 453.838 273.958 454.829ZM308.953 439.854L321.314 424.855C323.814 429.675 325.9 435.086 327.406 440.921C327.715 442.117 327.994 443.309 328.243 444.496L311.165 446.127C311.112 445.904 311.057 445.681 310.999 445.457C310.48 443.444 309.783 441.561 308.953 439.854ZM272.827 449.789C271.258 441.556 271.103 433.637 272.174 426.69L289.427 440.993C289.194 443.213 289.27 445.651 289.689 448.178L272.827 449.789ZM311.578 448.202C312.074 451.232 312.074 454.131 311.643 456.678L328.864 470.955C330.246 463.736 330.251 455.342 328.651 446.572L311.578 448.202ZM328.363 473.272L311.111 458.97C310.263 461.777 308.804 463.958 306.849 465.11L316.67 491.585C322.289 488.295 326.323 481.714 328.363 473.272ZM272.596 424.307L289.818 438.585C290.357 436.192 291.301 434.166 292.59 432.716L282.546 405.642C277.672 409.525 274.243 416.141 272.596 424.307Z"
                                fill="#4C4C4C"></path>
                        </g>
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M309.232 478.553C303.021 468.9 297.888 457.232 294.539 444.256C291.381 432.019 290.172 420.026 290.681 409.082L281.933 376.322L303.049 370.547C307.282 365.314 312.501 361.665 318.569 360.085C342.248 353.923 369.881 381.617 380.289 421.941C390.231 460.461 380.858 496.572 359.359 505.098L360.071 507.745L320.841 522.027L309.232 478.553Z"
                            fill="#000000"></path>
                        <ellipse rx="44.1906" ry="75.0554"
                            transform="matrix(-0.96712 0.251671 0.250086 0.968914 301.488 449.418)" fill="#000000">
                        </ellipse>
                        <g filter="url(#filter7_i_3_320)">
                            <g filter="url(#filter8_i_3_320)">
                                <ellipse rx="31.1942" ry="54.5293"
                                    transform="matrix(-0.972143 0.231385 0.244478 0.970347 300.647 449.338)"
                                    fill="url(#paint3_linear_3_320)"></ellipse>
                            </g>
                            <g filter="url(#filter9_di_3_320)">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M278.289 458.093C283.451 475.189 294.25 487.543 304.661 488.757L300.082 468.144C296.173 466.589 292.389 462.088 290.05 456.044L278.289 458.093ZM276.687 451.755C272.809 432.811 277.38 415.744 287.384 410.977L291.962 431.589C288.381 434.795 286.852 441.883 288.279 449.735L276.687 451.755ZM310.608 445.843C308.303 437.371 303.185 431.065 298.114 429.958L293.608 409.673C305.074 410.004 317.314 424.27 322.182 443.826L310.608 445.843ZM311.722 452.267L323.466 450.22C326.254 468.449 321.167 484.282 311.013 488.026L306.507 467.744C310.258 465.444 312.25 459.406 311.722 452.267Z"
                                    fill="#474747"></path>
                            </g>
                        </g>
                        <g filter="url(#filter10_ii_3_320)">
                            <path
                                d="M1029.78 574.106C1035.61 562.377 1034 552.009 1034.16 542.622L1033.83 518.68C1033.57 499.667 1033.52 483.376 1033.25 477.134C1032.99 470.892 1039.61 452.747 1006.06 419.759C975.931 390.138 910.15 356.21 893.821 352.082C877.493 347.953 807.241 249.966 781.358 230.969C704.053 174.231 509.317 121.391 461.344 122.058C433.541 121.267 318.151 180.698 305.305 188.878C238.884 231.173 283.93 213.889 235.307 277.473C232.06 280.921 230.074 298.754 230.931 307.718C229.749 310.99 227.125 317.779 226.88 318.978C225.358 326.434 230.752 363.287 230.852 370.47C230.969 378.861 229.519 394.106 231.298 402.557C233.078 411.007 254.69 430.966 254.863 428.401C254.732 418.987 255.333 417.291 257.603 402.191C263.773 378.615 274.92 368.059 283.881 366.042C302.626 361.823 319.922 369.328 333.826 392.889C360.611 438.278 350.021 467.095 353.87 486.353L594.199 606.91C591.791 593.535 592.341 599.3 591.754 590.911C591.021 580.426 590.47 531.04 620.886 520.065C647.686 510.394 682.404 543.848 698.877 571.136C712.697 594.03 723.816 641.198 726.022 666.211C738.76 672.484 785.376 698.105 856.199 674.77C995.687 628.812 1023.96 585.808 1029.78 574.106Z"
                                fill="url(#paint4_linear_3_320)"></path>
                        </g>
                        <mask id="mask0_3_320" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="226" y="122"
                            width="809" height="563">
                            <path
                                d="M1029.78 574.106C1035.61 562.377 1034 552.009 1034.16 542.622L1033.83 518.68C1033.57 499.667 1033.52 483.376 1033.25 477.134C1032.99 470.892 1039.61 452.747 1006.06 419.759C975.931 390.138 910.15 356.21 893.821 352.082C877.493 347.953 807.241 249.966 781.358 230.969C704.053 174.231 509.317 121.391 461.344 122.058C433.541 121.267 318.151 180.698 305.305 188.878C238.884 231.173 283.93 213.889 235.307 277.473C232.221 280.75 230.274 297.022 230.824 306.323C230.878 307.246 230.769 308.168 230.448 309.036C229.152 312.543 227.095 317.923 226.88 318.978C225.358 326.434 230.752 363.287 230.852 370.47C230.969 378.861 229.519 394.106 231.298 402.557C233.078 411.007 254.69 430.966 254.863 428.401C255.036 425.835 256.214 411.411 255.505 401.493C255.265 384.23 269.475 369.284 283.881 366.042C302.626 361.823 319.898 367.578 333.802 391.14C361.539 438.142 347.335 462.948 349.08 481.811C349.258 483.734 350.527 485.342 352.255 486.204L582.491 601.069C587.194 603.415 591.986 599.343 591.616 594.1C591.556 593.242 591.485 592.123 591.374 590.542C590.641 580.056 590.47 531.04 620.886 520.065C647.686 510.394 682.404 543.848 698.877 571.136C712.078 593.005 722.815 637.026 725.673 662.725C725.915 664.896 727.199 666.801 729.156 667.771C745.337 675.8 790.285 696.488 856.199 674.77C995.687 628.812 1023.96 585.808 1029.78 574.106Z"
                                fill="url(#paint5_linear_3_320)"></path>
                        </mask>
                        <g mask="url(#mask0_3_320)">
                            <g filter="url(#filter11_ddi_3_320)">
                                <path
                                    d="M656.765 432.227C633.823 415.009 635.369 392.971 599.741 330.63C597.613 326.907 599.139 322.128 603.063 320.399L780.604 242.192C783.165 241.064 786.455 240.609 788.586 242.422C794.117 247.126 807.741 261.166 841.295 301.821C862.505 327.519 866.559 333.947 882.286 349.449C884.16 351.297 880.474 356.312 872.548 363.031C847.28 384.451 695.219 461.087 656.765 432.227Z"
                                    fill="url(#paint6_linear_3_320)"></path>
                            </g>
                            <g filter="url(#filter12_di_3_320)">
                                <path
                                    d="M440.369 251.543C390.401 227.828 376.734 225.066 342.18 238.785C324.712 245.721 303.087 253.395 300.153 265.434C297.219 277.473 348.634 305.377 363.673 313.427C371.023 317.361 633.239 451.485 627.616 435.528C620.726 415.972 583.291 337.746 569.52 318.011C560.657 305.309 490.336 275.258 440.369 251.543Z"
                                    fill="url(#paint7_linear_3_320)"></path>
                            </g>
                            <g filter="url(#filter13_f_3_320)">
                                <path
                                    d="M723.054 532.569C659.024 503.884 622.761 467.263 583.963 433.867C698.566 466.117 938.485 536.842 934.809 541.713C930.214 547.802 913.156 555.186 856.199 559.822C800.123 564.386 730.385 535.853 723.054 532.569Z"
                                    fill="url(#paint8_linear_3_320)" fill-opacity="0.21"></path>
                            </g>
                            <g filter="url(#filter14_f_3_320)">
                                <path
                                    d="M966.75 388.019C963.094 385.097 917.018 338.662 882.683 315.703C911.556 370.164 977.306 488.498 983.258 487.818C990.698 486.969 1024.7 480.112 1034.42 456.78C1043.99 433.81 971.321 391.671 966.75 388.019Z"
                                    fill="url(#paint9_linear_3_320)" fill-opacity="0.13"></path>
                            </g>
                            <g filter="url(#filter15_di_3_320)">
                                <path
                                    d="M501.126 416.983C501.112 416.039 500.562 415.185 499.708 414.784L478.241 404.712C476.599 403.941 474.72 405.155 474.745 406.971L474.788 410.059C474.801 411.004 475.354 411.859 476.209 412.259L497.675 422.29C499.317 423.057 501.193 421.843 501.168 420.029L501.126 416.983Z"
                                    fill="#323232"></path>
                            </g>
                            <g filter="url(#filter16_di_3_320)">
                                <path
                                    d="M378.639 364.957C378.626 364.013 378.076 363.159 377.222 362.758L355.755 352.685C354.113 351.915 352.234 353.129 352.259 354.945L352.302 358.033C352.315 358.978 352.867 359.833 353.723 360.233L375.189 370.264C376.831 371.031 378.707 369.817 378.682 368.003L378.639 364.957Z"
                                    fill="#323232"></path>
                            </g>
                            <path
                                d="M805.624 401.196L668.435 292.509C651.891 297.236 614.461 315.101 607.297 317.906C598.016 321.54 598.456 326.903 598.456 326.903C598.495 329.72 598.133 327.754 601.171 333.292C606.214 342.483 610.258 350.693 621.183 374.386C639.949 415.084 643.969 425.342 659.659 434.461C671.477 441.33 696.102 442.356 725.808 432.094C752.361 422.92 782.815 411.856 805.624 401.196Z"
                                fill="#C4C4C4" fill-opacity="0.2"></path>
                            <g opacity="0.17" filter="url(#filter17_f_3_320)">
                                <path d="M1001.9 449.343C962.825 481.15 875.556 527.055 836.408 534.415"
                                    stroke="url(#paint10_linear_3_320)" stroke-width="81.1568" stroke-linecap="round"
                                    stroke-linejoin="round"></path>
                            </g>
                            <g filter="url(#filter18_dii_3_320)">
                                <path
                                    d="M1016.06 466.799C1023.63 456.271 1021.33 447.977 1020.02 434.86C1020 434.63 1019.94 434.379 1019.86 434.161C1016.16 423.501 1031.15 444.81 1032.88 459.65C1033.45 464.534 1033.17 467.015 1032.77 471.537C1032.59 473.605 1025.86 487.362 1026.53 490.075C1027.2 492.789 1026.76 513.306 1026.89 516.14C1027.03 518.975 1017.45 537.418 986.624 558.202C961.017 575.467 924.066 587.08 920.27 587.68C916.474 588.28 912.569 575.572 909.798 574.905C902.546 573.161 881.309 581.3 873.368 583.415C864.102 585.882 842.481 591.575 818.726 588.859C789.345 585.5 784.811 582.229 757.645 567.922C739.15 558.182 725.989 538.695 721.496 528.406C720.659 526.491 722.381 524.759 724.378 525.376C742.118 530.851 782.392 545.165 827.96 549.196C892.778 554.93 943.475 523.458 950.738 518.934C981.268 499.918 997.344 492.82 1016.06 466.799Z"
                                    fill="#141414"></path>
                            </g>
                            <mask id="mask1_3_320" style="mask-type:alpha" maskUnits="userSpaceOnUse" x="722" y="435"
                                width="315" height="155">
                                <path
                                    d="M1016.09 466.673C1022.09 458.315 1022.27 448.67 1020.62 440.245C1019.73 435.685 1024.18 433.177 1026.62 437.164C1032.66 447.009 1035.29 455.414 1036.07 460.056C1036.64 464.941 1036.56 468.049 1036.17 472.57C1035.99 474.638 1025.63 486.505 1026.3 489.218C1026.97 491.931 1026.57 508.725 1026.66 514.694C1026.74 520.663 1017.53 537.29 986.716 558.093C961.119 575.373 924.176 587.009 920.38 587.611C916.585 588.214 912.671 575.508 909.9 574.843C902.647 573.103 881.414 581.255 873.475 583.374C864.21 585.847 842.592 591.553 818.836 588.852C789.452 585.511 784.915 582.242 757.74 567.952C740.477 558.875 727.851 541.309 722.582 530.643C721.158 527.76 723.716 525.19 726.795 526.16C745.578 532.073 784.384 545.348 828.043 549.183C892.866 554.878 943.543 523.376 950.803 518.847C981.32 499.813 997.392 492.705 1016.09 466.673Z"
                                    fill="#272727"></path>
                            </mask>
                            <g mask="url(#mask1_3_320)">
                                <g filter="url(#filter19_d_3_320)">
                                    <path
                                        d="M768.62 534.147L855.724 534.248C855.73 534.264 855.736 534.281 855.742 534.297C855.992 534.992 856.314 536.002 856.584 537.234C857.128 539.71 857.449 543.009 856.647 546.437C855.854 549.829 853.947 553.419 849.907 556.533C845.838 559.668 839.52 562.385 829.817 563.825C824.053 564.68 816.064 564.762 807.836 563.319C799.602 561.875 791.251 558.925 784.656 553.816C781.09 551.053 776.683 545.561 773.088 540.6C771.311 538.149 769.768 535.878 768.668 534.219C768.652 534.195 768.636 534.171 768.62 534.147Z"
                                        stroke="white" stroke-opacity="0.9" stroke-width="3.41524"></path>
                                </g>
                                <g filter="url(#filter20_d_3_320)">
                                    <path
                                        d="M1020.27 439.492C1020.28 439.505 1020.29 439.518 1020.3 439.531C1021.12 440.935 1022.15 442.962 1022.98 445.44C1024.63 450.394 1025.44 457.076 1022.24 464.238C1021.32 466.276 1020.01 467.642 1018.65 468.212C1017.39 468.741 1015.87 468.688 1014.13 467.408C1012.93 466.525 1011.28 466.19 1009.78 466.061C1008.22 465.927 1006.52 465.995 1004.98 466.134C1004.32 466.193 1003.68 466.266 1003.09 466.344L1020.27 439.492Z"
                                        stroke="white" stroke-opacity="0.9" stroke-width="3.41524"></path>
                                </g>
                            </g>
                        </g>
                        <g filter="url(#filter21_f_3_320)">
                            <path
                                d="M603.039 496.629L364.62 387.993C362.415 386.988 360.1 389.427 361.081 391.643C372.214 416.775 370.866 443.406 370.408 456.319C370.373 457.305 370.922 458.209 371.806 458.647L585.411 564.225C587.101 565.06 589.08 563.808 589.095 561.923C589.329 532.474 596.498 511.022 603.816 502.522C605.245 500.863 605.031 497.537 603.039 496.629Z"
                                fill="url(#paint11_linear_3_320)" fill-opacity="0.12"></path>
                        </g>
                        <defs>
                            <filter id="filter0_f_3_320" x="137.566" y="328.83" width="926.222" height="426.464"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feGaussianBlur stdDeviation="8.67815" result="effect1_foregroundBlur_3_320">
                                </feGaussianBlur>
                            </filter>
                            <filter id="filter1_i_3_320" x="604.672" y="549.585" width="89.6853" height="124.34"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feMorphology radius="1.22965" operator="erode" in="SourceAlpha"
                                    result="effect1_innerShadow_3_320"></feMorphology>
                                <feOffset></feOffset>
                                <feGaussianBlur stdDeviation="0.614824"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter2_di_3_320" x="608.541" y="559.845" width="78.9477" height="106.036"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.491859"></feOffset>
                                <feGaussianBlur stdDeviation="0.368894"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.41 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-3.68894" dy="2.4593"></feOffset>
                                <feGaussianBlur stdDeviation="1.84447"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter3_i_3_320" x="608.093" y="551.48" width="83.7218" height="120.532"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feMorphology radius="1.05801" operator="erode" in="SourceAlpha"
                                    result="effect1_innerShadow_3_320"></feMorphology>
                                <feOffset></feOffset>
                                <feGaussianBlur stdDeviation="0.529003"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter4_di_3_320" x="614.637" y="566.805" width="67.1642" height="92.3959"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.576395"></feOffset>
                                <feGaussianBlur stdDeviation="0.432296"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.41 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-4.32296" dy="2.88197"></feOffset>
                                <feGaussianBlur stdDeviation="2.16148"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter5_i_3_320" x="265.584" y="392.514" width="70.2628" height="110.727"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feMorphology radius="1.05175" operator="erode" in="SourceAlpha"
                                    result="effect1_innerShadow_3_320"></feMorphology>
                                <feOffset></feOffset>
                                <feGaussianBlur stdDeviation="0.525873"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter6_di_3_320" x="268.332" y="401.656" width="62.1767" height="94.3308"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.420698"></feOffset>
                                <feGaussianBlur stdDeviation="0.315524"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.41 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-3.15524" dy="2.10349"></feOffset>
                                <feGaussianBlur stdDeviation="1.57762"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter7_i_3_320" x="267.513" y="395.929" width="66.269" height="106.818"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feMorphology radius="0.935097" operator="erode" in="SourceAlpha"
                                    result="effect1_innerShadow_3_320"></feMorphology>
                                <feOffset></feOffset>
                                <feGaussianBlur stdDeviation="0.467549"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter8_i_3_320" x="267.513" y="395.929" width="66.269" height="106.818"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feMorphology radius="1.05801" operator="erode" in="SourceAlpha"
                                    result="effect1_innerShadow_3_320"></feMorphology>
                                <feOffset></feOffset>
                                <feGaussianBlur stdDeviation="0.529003"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter9_di_3_320" x="270.99" y="409.385" width="54.0975" height="82.2548"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.576395"></feOffset>
                                <feGaussianBlur stdDeviation="0.432296"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.41 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-4.32296" dy="2.88197"></feOffset>
                                <feGaussianBlur stdDeviation="2.16148"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter10_ii_3_320" x="226.61" y="110.523" width="816.288" height="573.875"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="8.64592" dy="-11.5279"></feOffset>
                                <feGaussianBlur stdDeviation="34.5837"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.07 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect1_innerShadow_3_320"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="-1.44099"></feOffset>
                                <feGaussianBlur stdDeviation="2.88197"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="effect1_innerShadow_3_320"
                                    result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter11_ddi_3_320" x="593.859" y="237.513" width="291.366" height="204.817"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-2.4593" dy="1.22965"></feOffset>
                                <feGaussianBlur stdDeviation="1.22965"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.28 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="-1.22965"></feOffset>
                                <feGaussianBlur stdDeviation="1.22965"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.56 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="effect1_dropShadow_3_320"
                                    result="effect2_dropShadow_3_320"></feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect2_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-1.22965" dy="3.68894"></feOffset>
                                <feGaussianBlur stdDeviation="1.84447"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.75 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect3_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter12_di_3_320" x="293.997" y="230.518" width="334.614" height="210.697"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.905297"></feOffset>
                                <feGaussianBlur stdDeviation="0.452649"></feGaussianBlur>
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.925374 0 0 0 0 0.925374 0 0 0 0 0.925374 0 0 0 0.37 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="-6.03563" dy="4.36889"></feOffset>
                                <feGaussianBlur stdDeviation="3.01781"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.63 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter13_f_3_320" x="549.532" y="399.437" width="419.749" height="195.309"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feGaussianBlur stdDeviation="17.2151" result="effect1_foregroundBlur_3_320">
                                </feGaussianBlur>
                            </filter>
                            <filter id="filter14_f_3_320" x="860.549" y="293.569" width="196.871" height="216.385"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feGaussianBlur stdDeviation="11.0668" result="effect1_foregroundBlur_3_320">
                                </feGaussianBlur>
                            </filter>
                            <filter id="filter15_di_3_320" x="474.135" y="403.256" width="27.6429" height="22.3174"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="-0.609879"></feOffset>
                                <feGaussianBlur stdDeviation="0.304939"></feGaussianBlur>
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.78755 0 0 0 0 0.78755 0 0 0 0 0.78755 0 0 0 0.19 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="3.04939"></feOffset>
                                <feGaussianBlur stdDeviation="1.5247"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.74 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter16_di_3_320" x="351.649" y="351.23" width="27.6429" height="22.3174"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="-0.609879"></feOffset>
                                <feGaussianBlur stdDeviation="0.304939"></feGaussianBlur>
                                <feColorMatrix type="matrix"
                                    values="0 0 0 0 0.78755 0 0 0 0 0.78755 0 0 0 0 0.78755 0 0 0 0.19 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="3.04939"></feOffset>
                                <feGaussianBlur stdDeviation="1.5247"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.74 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter17_f_3_320" x="783.526" y="396.467" width="271.248" height="190.83"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feGaussianBlur stdDeviation="6.14824" result="effect1_foregroundBlur_3_320">
                                </feGaussianBlur>
                            </filter>
                            <filter id="filter18_dii_3_320" x="718.304" y="429.002" width="317.874" height="164.244"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.694325"></feOffset>
                                <feGaussianBlur stdDeviation="1.48756"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.63 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="0.694325"></feOffset>
                                <feGaussianBlur stdDeviation="0.694325"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="shape" result="effect2_innerShadow_3_320"></feBlend>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dy="-0.694325"></feOffset>
                                <feGaussianBlur stdDeviation="0.694325"></feGaussianBlur>
                                <feComposite in2="hardAlpha" operator="arithmetic" k2="-1" k3="1">
                                </feComposite>
                                <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="effect2_innerShadow_3_320"
                                    result="effect3_innerShadow_3_320"></feBlend>
                            </filter>
                            <filter id="filter19_d_3_320" x="765.199" y="532.436" width="96.191" height="36.5414"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="1.13841" dy="1.41412"></feOffset>
                                <feGaussianBlur stdDeviation="0.707062"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.24 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                            </filter>
                            <filter id="filter20_d_3_320" x="999.295" y="436.358" width="29.3925" height="36.7061"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feColorMatrix in="SourceAlpha" type="matrix"
                                    values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha">
                                </feColorMatrix>
                                <feOffset dx="1.13841" dy="1.41412"></feOffset>
                                <feGaussianBlur stdDeviation="0.707062"></feGaussianBlur>
                                <feColorMatrix type="matrix" values="0 0 0 0 1 0 0 0 0 1 0 0 0 0 1 0 0 0 0.24 0">
                                </feColorMatrix>
                                <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_3_320">
                                </feBlend>
                                <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_3_320"
                                    result="shape"></feBlend>
                            </filter>
                            <filter id="filter21_f_3_320" x="357.067" y="383.978" width="251.453" height="184.293"
                                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
                                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape">
                                </feBlend>
                                <feGaussianBlur stdDeviation="1.89119" result="effect1_foregroundBlur_3_320">
                                </feGaussianBlur>
                            </filter>
                            <linearGradient id="paint0_linear_3_320" x1="91.6912" y1="100.732" x2="96.2567"
                                y2="32.8232" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#3F3F3F"></stop>
                                <stop offset="1" stop-color="#5C5C5C"></stop>
                            </linearGradient>
                            <linearGradient id="paint1_linear_3_320" x1="85.732" y1="88.4131" x2="60.0114"
                                y2="-29.6115" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#3F3F3F"></stop>
                                <stop offset="1" stop-color="#777676"></stop>
                            </linearGradient>
                            <linearGradient id="paint2_linear_3_320" x1="78.4318" y1="86.1513" x2="82.3358"
                                y2="28.0721" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#3F3F3F"></stop>
                                <stop offset="1" stop-color="#5C5C5C"></stop>
                            </linearGradient>
                            <linearGradient id="paint3_linear_3_320" x1="73.4055" y1="75.7095" x2="51.3784"
                                y2="-25.3558" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#3F3F3F"></stop>
                                <stop offset="1" stop-color="#777676"></stop>
                            </linearGradient>
                            <linearGradient id="paint4_linear_3_320" x1="752.001" y1="683.944" x2="1028.06"
                                y2="287.729" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#262626"></stop>
                                <stop offset="0.628054" stop-color="#545454"></stop>
                                <stop offset="1" stop-color="#A8A8A8"></stop>
                            </linearGradient>
                            <linearGradient id="paint5_linear_3_320" x1="723.618" y1="562.12" x2="520.124"
                                y2="113.44" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#CECBCB"></stop>
                                <stop offset="1" stop-color="white"></stop>
                            </linearGradient>
                            <linearGradient id="paint6_linear_3_320" x1="751.752" y1="97.2429" x2="532.864"
                                y2="310.206" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E8EAE9"></stop>
                                <stop offset="0.498386" stop-color="#707072"></stop>
                                <stop offset="1" stop-color="#2F3032"></stop>
                            </linearGradient>
                            <linearGradient id="paint7_linear_3_320" x1="893.239" y1="885.121" x2="761.647"
                                y2="206.626" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#E8EAE9"></stop>
                                <stop offset="0.498386" stop-color="#707072"></stop>
                                <stop offset="1" stop-color="#2F3032"></stop>
                            </linearGradient>
                            <linearGradient id="paint8_linear_3_320" x1="748.993" y1="569.184" x2="775.401"
                                y2="488.331" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#ECEAEA"></stop>
                                <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint9_linear_3_320" x1="1059.84" y1="421.479" x2="956.466"
                                y2="459.179" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#ECEAEA"></stop>
                                <stop offset="1" stop-color="white" stop-opacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint10_linear_3_320" x1="922.274" y1="532.342" x2="903.212"
                                y2="496.506" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#4B4B4B"></stop>
                                <stop offset="0.899322" stop-opacity="0"></stop>
                            </linearGradient>
                            <linearGradient id="paint11_linear_3_320" x1="448.966" y1="547.446" x2="501.946"
                                y2="449.232" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#040404"></stop>
                                <stop offset="1" stop-color="#3C3C3C" stop-opacity="0"></stop>
                            </linearGradient>
                        </defs>
                    </g>
                </svg>
                <h1 class="text-lg md:text-2xl font-semibold text-gray-900">Veículos</h1>
            </div>
            <div class="flex flex-col space-y-2 w-full md:flex-row md:space-x-4 md:space-y-0 md:w-auto">
                <button id="filterBtn"
                    class="w-full md:w-auto px-4 py-2 bg-gray-600 text-white rounded-md shadow-sm hover:bg-gray-700">
                    Filtros
                </button>
                <a href="{{ route('vehicles.index', ['clear_filters' => true]) }}"
                    class="w-full md:w-auto px-4 py-2 bg-gray-700 text-white rounded-md shadow-sm hover:bg-gray-800 text-center">
                    Limpar
                </a>
            </div>
        </div>
    </div>

    <div id="filterModal" class="modal mx-auto lg:pl-64">
        <div class="modal-content">
            <span class="close">&times;</span>
            <form method="GET" action="{{ route('vehicles.index') }}">
                <input type="text" name="search" id="filter-plate" placeholder="Pesquisar por matrícula">
                <select name="is_external" id="filter-is-external">
                    <option value="">Filtrar por externo/interno</option>
                    <option value="1" {{ request('is_external') == '1' ? 'selected' : '' }}>Externo</option>
                    <option value="0" {{ request('is_external') == '0' ? 'selected' : '' }}>Interno</option>
                </select>
                <select name="fuel_type" id="filter-fuel-type">
                    <option value="">Filtrar por combustível</option>
                    @foreach ($fuelTypes as $fuelType)
                        <option value="{{ $fuelType->id }}"
                            {{ request('fuel_type') == $fuelType->id ? 'selected' : '' }}>
                            {{ $fuelType->type }}
                        </option>
                    @endforeach
                </select>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="rental_expired" id="filter-rental-expired"
                        value="1" {{ request('rental_expired') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="filter-rental-expired">
                        Aluguer expirado
                    </label>
                    <div class="mr-10"></div>

                    <input class="form-check-input" type="checkbox" name="filter_activity" id="filter_activity"
                        value="1" {{ request('filter_activity') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="filter_activity">
                        Veiculos não usados
                    </label>
                </div>
                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <form id="multi-delete-form" action="{{ route('vehicles.deleteSelected') }}" method="POST"
        style="display: inline-block;">
        @csrf
        @method('DELETE')
        <input type="hidden" name="selected_ids[]" id="selected-ids">
        <button id="deleteButton" type="submit" class="text-red-600 hover:text-red-900 ml-2 delete-link"
            title="Remover">
            <i class="fas fa-trash-alt text-lg"></i>
        </button>
    </form>

    @include('components.Modals.modal-delete')

    <a href="{{ route('vehicles.create') }}" class="add-button">
        <i class="fas fa-plus"></i>
    </a>

    <div class="list-table">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>MATRÍCULA</th>
                    <th>MARCA</th>
                    <th>CATEGORIA</th>
                    <th>TIPO DE COMBUSTÍVEL</th>
                    <th>ATIVIDADE</th>
                    <th>EXTERNO</th>
                    <th>AÇÕES</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vehicles as $vehicle)
                    <tr data-url='{{ url('vehicles/' . $vehicle->id) }}' style="cursor:pointer;">
                        <td>
                            <input type="checkbox" name="selected_ids[]" value="{{ $vehicle->id }}"
                                class="form-checkbox">
                        </td>
                        <td><a href="{{ url('vehicles/' . $vehicle->id) }}">{{ $vehicle->plate }}</a></td>
                        <td>{{ $vehicle->brand->name }}</td>
                        <td>{{ $vehicle->carCategory->category }}</td>
                        <td>{{ $vehicle->fuelType->type }}</td>
                        <td>
                            @if ($vehicle->is_active)
                                <span
                                    class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Em viagem
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Sem viagem
                                </span>
                            @endif
                        </td>
                        <td>
                            @if ($vehicle->is_external)
                                <span
                                    class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    Sim
                                </span>
                            @else
                                <span
                                    class="px-2 inline-flex text-lg leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    Não
                                </span>
                            @endif
                        </td>

                        <td class="table-actions">
                            <a href="{{ url('vehicles/' . $vehicle->id . '/edit') }}" class="btn-action btn-edit">
                                <i class="fas fa-edit text-xl"></i>
                            </a>
                            <button type="button" class="btn-action btn-delete" data-id="{{ $vehicle->id }}">
                                <i class="fas fa-trash-alt text-xl"></i>
                            </button>
                            <form id="delete-form-{{ $vehicle->id }}" method="post"
                                action="{{ route('vehicles.destroy', $vehicle->id) }}" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                            <a href="{{ url('vehicles/' . $vehicle->id) }}" class="btn-action btn-view">
                                <i class="fas fa-eye text-xl"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"
                            class="px-6 py-4 whitespace-nowrap text-center text-lg font-medium text-gray-500">
                            <img src="{{ asset('images/notfounditem.png') }}" alt="Nenhum registro encontrado"
                                class="w-64 h-64 mx-auto">
                            <p class="mt-4 text-center">Nenhum veículo encontrado</p>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="flex justify-center mr-10 ">
    {{ $vehicles->links() }}
</div>

@include('components.Modals.modal-delete')

<style>
    .btn-action {
        padding: 6px 12px;
        font-size: 16px;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn-edit i,
    .btn-view i {
        color: #2d2d2d;
    }

    .btn-delete i {
        color: #dc3545;
    }

    .btn-delete:hover i {
        color: #c82333;
    }

    .btn-edit:hover i,
    .btn-view:hover i {
        color: #2d2c2a;
    }
</style>
