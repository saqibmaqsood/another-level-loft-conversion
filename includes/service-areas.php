<?php
$serviceAreasData = [
    [
        'name' => 'Greater Manchester',
        'team' => 'Manchester team',
        'towns' => [
            'Altrincham', 'Ashton-in-Makerfield', 'Ashton-under-Lyne', 'Bolton', 'Bury',
            'Chorlton', 'Didsbury', 'Eccles', 'Horwich', 'Manchester', 'Middleton', 'Oldham', 'Reddish', 'Sale', 'Salford',
            'Standish', 'Stockport', 'Stretford', 'Westhoughton', 'Wigan', 'Worsley'
        ]
    ],
    [
        'name' => 'Lancashire',
        'team' => 'Preston team',
        'towns' => [
            'Blackpool', 'Burnley', 'Chorley', 'Clitheroe', 'Garstang', 'Kirkham',
            'Leyland', 'Longridge', 'Lytham', "Lytham St Anne's", 'Ormskirk', 'Penwortham', 'Poulton',
            'Preston', 'Skelmersdale', 'Thornton'
        ]
    ],
    [
        'name' => 'Cheshire & Merseyside',
        'team' => 'Both teams',
        'towns' => [
            'Lymm', 'Southport', 'St Helens', 'Warrington'
        ]
    ]
];

if (!isset($activeCity)) {
    $activeCity = "";
}

if (!function_exists('getTownSlug')) {
    function getTownSlug($townName) {
        $map = [
            "Lytham St Anne's" => "lytham-st-annes",
            "St Helens" => "st-helens",
            "Ashton-in-Makerfield" => "ashton-in-makerfield",
            "Ashton-under-Lyne" => "ashton-under-lyne"
        ];
        $base = isset($map[$townName]) ? $map[$townName] : strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $townName), '-'));
        return 'loft-conversions-in-' . $base;
    }
}
?>
<section id="areas" data-reveal aria-labelledby="area-h" class="section-padding bg-white">
  <div class="container">
    <div class="areas-header" style="display:flex;flex-wrap:wrap;gap:24px 48px;align-items:flex-end;justify-content:space-between;margin-bottom:36px">
      <div style="flex:2 1 460px">
        <span class="section-label">Where we work</span>
        <h2 id="area-h" class="heading-h2">Forty-one towns across the North West.</h2>
      </div>
      <p class="areas-header-desc" style="flex:1 1 280px;max-width:38ch;font-size:17px;line-height:1.6;color:#4A4A45;margin:0">We cover Preston, Manchester, Lancashire and Cheshire. Pick your town for local prices, recent projects and planning notes.</p>
    </div>

    <!-- Stats Grid -->
    <div class="areas-stats-grid" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:1px;background:#E4E4DF;border:1px solid #E4E4DF;margin-bottom:8px">
      <div class="area-stat-box" style="background:#FFFFFF;padding:22px;display:flex;flex-direction:column;gap:6px">
        <span class="area-stat-num" style="font-family:Newsreader,Georgia,serif;font-size:clamp(26px,3vw,34px);line-height:1;letter-spacing:-.02em">41</span>
        <span class="area-stat-label" style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Towns covered</span>
      </div>
      <div class="area-stat-box" style="background:#FFFFFF;padding:22px;display:flex;flex-direction:column;gap:6px">
        <span class="area-stat-num" style="font-family:Newsreader,Georgia,serif;font-size:clamp(26px,3vw,34px);line-height:1;letter-spacing:-.02em">400+</span>
        <span class="area-stat-label" style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Conversions completed</span>
      </div>
      <div class="area-stat-box" style="background:#FFFFFF;padding:22px;display:flex;flex-direction:column;gap:6px">
        <span class="area-stat-num" style="font-family:Newsreader,Georgia,serif;font-size:clamp(26px,3vw,34px);line-height:1;letter-spacing:-.02em">5 days</span>
        <span class="area-stat-label" style="font-family:'IBM Plex Mono',monospace;font-size:11px;letter-spacing:.12em;text-transform:uppercase;color:#6B6B6B">Typical wait for a survey</span>
      </div>
    </div>

    <!-- Groups & Town Pills -->
    <div class="areas-groups-container">
      <?php foreach ($serviceAreasData as $idx => $g): ?>
        <div class="area-group-row" style="display:grid;grid-template-columns:repeat(auto-fit,minmax(190px,1fr));gap:14px 32px;padding:26px 0;<?php echo ($idx > 0) ? 'border-top:1px solid #E4E4DF;' : ''; ?>align-items:start">
          <div class="area-group-info" style="display:flex;flex-direction:column;gap:4px">
            <span class="area-group-title" style="font-size:15px;font-weight:600;line-height:1.25"><?php echo $g['name']; ?></span>
            <span class="area-group-count" style="font-family:'IBM Plex Mono',monospace;font-size:11px;color:#6B8E5A"><?php echo count($g['towns']); ?> towns</span>
          </div>
          <ul class="area-towns-list" style="list-style:none;margin:0;padding:0;display:flex;flex-wrap:wrap;gap:8px;grid-column:span 2">
            <?php foreach ($g['towns'] as $t): 
              $slug = getTownSlug($t);
            ?>
              <li style="display:flex">
                <a href="<?php echo $slug; ?>.php" class="town-pill <?php echo ($activeCity === $t) ? 'active' : ''; ?>">
                  <?php echo $t; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="areas-footer" style="display:flex;flex-wrap:wrap;gap:16px 32px;align-items:center;justify-content:space-between;border-top:1px solid #E4E4DF;padding-top:24px">
      <p class="areas-address" style="font-family:'IBM Plex Mono',monospace;font-size:12px;color:#6B6B6B;margin:0">Old Docks House, 90 Watery Lane, Preston PR2 1AU</p>
      <p class="areas-unlisted" style="font-size:15px;margin:0;color:#4A4A45">Town not listed? <a href="tel:08000862744" style="font-weight:600;color:#4F6B42;border-bottom:1px solid #6B8E5A;text-decoration:none">Call 0800 0862744</a> &mdash; we travel further for larger jobs.</p>
    </div>
  </div>
</section>
