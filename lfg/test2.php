<svg viewBox="0 0 300 300" xmlns="http://www.w3.org/2000/svg">

  <!-- to hide the path, it is usually wrapped in a <defs> element -->
  <!-- <defs> -->
  <path id="MyPath" fill="none" stroke="red"
        d="M10,90 Q90,90 90,45 Q90,10 50,10 Q10,10 10,40 Q10,70 45,70 Q70,70 75,50" />
  <!-- </defs> -->
<input type="text" value="<text><textPath href=#MyPath>">
  <text>
    <textPath href="#MyPath">
      Quick brown fox jumps over the lazy dog.
    </textPath>
  </text>
</input>
</svg>