<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


function no_admitidos()
{
    $array = [
        5,  63,   66,    76, 89,  92,   110,   130,   140,   141,   152,   158,   161,   164,   
        170,   196,   199,   209,   210,   214,   216,   217,   225,   240,   247,   255,   257,   
        263,   264,   327,   344,   348,   383,   384,   413,   415,   416,   431,   440,   443,   
        458,   487,   514,   529,   534,   551,   557,   578,   604,   613,   642,   645,   673,   
        677,   680,   688,   689,   701,   717,   732,   733,   756,   758,   794,   799,   806,   
        818,   842,   855,   856,   864,   878,   889,   930,   955,   968,   970,   972,   985,   
        990,   995,   1022,  1049, 1049,    1093,   1108,  1128, 1130,    1139,   1157,  1165, 1181,    
        1216,   1240,  1258, 1288,    1342,   1351,  1378, 1388,    1408,   1442,  1484, 1494,    1537,   
        1554,  1582, 1665,    1667,   1715,  1742, 1749,    1762,   1815,  1841, 1857,    1864,   1914,  
        1942, 1944,    1970,   1986,  2002, 2083,    2137,   2210,  2241, 2351,    2359,   2436,  2483, 
        2513,    2546,   2601,  2601, 2670,    2671,   2672,  2673, 2674,    2675,   2714  ];
     
    return $array;
}