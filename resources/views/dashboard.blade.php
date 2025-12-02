@extends('layouts.master')
@section('content')
      <section id="overview" class="section">
        <h2 class="title" style="color: black; font-weight: bold; font-size: 26px;">Dashboard Overview</h2>
        <div class="cards">
          <article class="card color-1">
            <div class="card-value">1</div>
            <div class="card-label">Orders</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <!-- Shopping bag icon -->
              <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" focusable="false">
                <path d="M14 18h20c1.1 0 2 .9 2 2l-2 18c-.1 1-1 2-2 2H16c-1 0-1.9-.9-2-2l-2-18c0-1.1.9-2 2-2z"
                  fill="currentColor" opacity=".3" />
                <path
                  d="M30 18v-2a6 6 0 0 0-12 0v2h-2v-2a8 8 0 0 1 16 0v2h-2zM18 24a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm12 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
                  fill="currentColor" />
                <path d="M12 18h24" stroke="currentColor" stroke-width="2" stroke-linecap="round" opacity=".6" />
              </svg>
            </div>
          </article>
          <article class="card color-2">
            <div class="card-value">1</div>
            <div class="card-label">Lot Items</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" focusable="false">
                <rect x="6" y="22" width="6" height="20" rx="2" />
                <rect x="18" y="14" width="6" height="28" rx="2" />
                <rect x="30" y="8" width="6" height="34" rx="2" />
                <rect x="42" y="4" width="6" height="38" rx="2" />
              </svg>
            </div>
          </article>
          <article class="card color-3">
            <div class="card-value">1</div>
            <div class="card-label">Pending Lot Items</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" focusable="false">
                <rect x="6" y="22" width="6" height="20" rx="2" />
                <rect x="18" y="14" width="6" height="28" rx="2" />
                <rect x="30" y="8" width="6" height="34" rx="2" />
                <rect x="42" y="4" width="6" height="38" rx="2" />
              </svg>
            </div>
          </article>
          <article class="card color-4">
            <div class="card-value">333.900</div>
            <div class="card-label">Fine Gold >> Gold</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 496.4 496.4"
                style="enable-background:new 0 0 496.4 496.4;" xml:space="preserve">
                <path style="fill:#FF9100;" d="M181,489.8c-8.8,8.8-22.4,8.8-31.2,0L6.6,346.6c-8.8-8.8-8.8-22.4,0-31.2L309.8,12.2
                  c8.8-8.8,22.4-8.8,31.2,0l143.2,143.2c8.8,8.8,8.8,22.4,0,31.2L181,489.8z" />
                <path style="fill:#FFC200;" d="M186.6,484.2c-8.8,8.8-22.4,8.8-31.2,0L12.2,341.8c-8.8-8.8-8.8-22.4,0-31.2l303.2-304
                  c8.8-8.8,22.4-8.8,31.2,0l143.2,143.2c8.8,8.8,8.8,22.4,0,31.2L186.6,484.2z" />
                <path style="fill:#FFB000;"
                  d="M346.6,6.6l143.2,143.2c8.8,8.8,8.8,22.4,0,31.2L186.6,484.2c-8.8,8.8-22.4,8.8-31.2,0" />
                <path style="fill:#FF9700;"
                  d="M489.8,149.8c8.8,8.8,8.8,22.4,0,31.2L186.6,484.2c-8.8,8.8-22.4,8.8-31.2,0" />
                <path style="fill:#FFDA00;"
                  d="M12.2,341.8c-8.8-8.8-8.8-22.4,0-31.2l303.2-304c8.8-8.8,22.4-8.8,31.2,0" />
                <g>
                  <ellipse style="fill:#FF9100;" cx="77.8" cy="125.8" rx="3.2" ry="56.8" />
                  <ellipse style="fill:#FF9100;" cx="77.8" cy="125.8" rx="56.8" ry="3.2" />
                </g>
                <g>
                  <ellipse transform="matrix(0.7065 -0.7077 0.7077 0.7065 6.7941 121.5156)" style="fill:#FFC200;"
                    cx="149.904" cy="52.566" rx="30.4" ry="1.6" />
                  <ellipse transform="matrix(0.7084 0.7059 -0.7059 0.7084 80.9744 -89.9596)" style="fill:#FFC200;"
                    cx="149.35" cy="53.01" rx="30.402" ry="1.6" />
                </g>
                <g>
                  <ellipse transform="matrix(0.7065 -0.7077 0.7077 0.7065 -117.0745 207.9012)" style="fill:#FFDA00;"
                    cx="192.121" cy="245.103" rx="30.4" ry="1.6" />
                  <ellipse transform="matrix(0.7084 0.7059 -0.7059 0.7084 228.9156 -63.9787)" style="fill:#FFDA00;"
                    cx="191.88" cy="245.028" rx="30.402" ry="1.6" />
                  <path style="fill:#FFDA00;" d="M358.6,155.4c0,31.2-1.6,56.8-3.2,56.8s-3.2-25.6-3.2-56.8s1.6-56.8,3.2-56.8
                    C357,98.6,358.6,124.2,358.6,155.4z" />
                  <ellipse style="fill:#FFDA00;" cx="355.4" cy="155.4" rx="56.8" ry="3.2" />
                </g>
              </svg>
            </div>
          </article>
          <article class="card color-5">
            <div class="card-value">6300.900</div>
            <div class="card-label">Fine Silver >> Silver</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <!-- Silver themed version of provided SVG -->
              <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" viewBox="0 0 496.4 496.4" style="enable-background:new 0 0 496.4 496.4;" xml:space="preserve">
                <path style="fill:#9CA3AF;" d="M181,489.8c-8.8,8.8-22.4,8.8-31.2,0L6.6,346.6c-8.8-8.8-8.8-22.4,0-31.2L309.8,12.2
                  c8.8-8.8,22.4-8.8,31.2,0l143.2,143.2c8.8,8.8,8.8,22.4,0,31.2L181,489.8z" />
                <path style="fill:#D1D5DB;" d="M186.6,484.2c-8.8,8.8-22.4,8.8-31.2,0L12.2,341.8c-8.8-8.8-8.8-22.4,0-31.2l303.2-304
                  c8.8-8.8,22.4-8.8,31.2,0l143.2,143.2c8.8,8.8,8.8,22.4,0,31.2L186.6,484.2z" />
                <path style="fill:#A3AEB8;"
                  d="M346.6,6.6l143.2,143.2c8.8,8.8,8.8,22.4,0,31.2L186.6,484.2c-8.8,8.8-22.4,8.8-31.2,0" />
                <path style="fill:#BFC5CC;"
                  d="M489.8,149.8c8.8,8.8,8.8,22.4,0,31.2L186.6,484.2c-8.8,8.8-22.4,8.8-31.2,0" />
                <path style="fill:#E5E7EB;"
                  d="M12.2,341.8c-8.8-8.8-8.8-22.4,0-31.2l303.2-304c8.8-8.8,22.4-8.8,31.2,0" />
                <g>
                  <ellipse style="fill:#9CA3AF;" cx="77.8" cy="125.8" rx="3.2" ry="56.8" />
                  <ellipse style="fill:#9CA3AF;" cx="77.8" cy="125.8" rx="56.8" ry="3.2" />
                </g>
                <g>
                  <ellipse transform="matrix(0.7065 -0.7077 0.7077 0.7065 6.7941 121.5156)" style="fill:#D1D5DB;"
                    cx="149.904" cy="52.566" rx="30.4" ry="1.6" />
                  <ellipse transform="matrix(0.7084 0.7059 -0.7059 0.7084 80.9744 -89.9596)" style="fill:#D1D5DB;"
                    cx="149.35" cy="53.01" rx="30.402" ry="1.6" />
                </g>
                <g>
                  <ellipse transform="matrix(0.7065 -0.7077 0.7077 0.7065 -117.0745 207.9012)" style="fill:#E5E7EB;"
                    cx="192.121" cy="245.103" rx="30.4" ry="1.6" />
                  <ellipse transform="matrix(0.7084 0.7059 -0.7059 0.7084 228.9156 -63.9787)" style="fill:#E5E7EB;"
                    cx="191.88" cy="245.028" rx="30.402" ry="1.6" />
                  <path style="fill:#E5E7EB;" d="M358.6,155.4c0,31.2-1.6,56.8-3.2,56.8s-3.2-25.6-3.2-56.8s1.6-56.8,3.2-56.8
                    C357,98.6,358.6,124.2,358.6,155.4z" />
                  <ellipse style="fill:#E5E7EB;" cx="355.4" cy="155.4" rx="56.8" ry="3.2" />
                </g>
              </svg>
            </div>
          </article>
          <article class="card color-6">
            <div class="card-value">0</div>
            <div class="card-label">Cash</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <!-- Cash icon -->
              <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" focusable="false">
                <rect x="6" y="14" width="36" height="20" rx="3" ry="3" fill="currentColor" opacity=".12" />
                <rect x="9" y="17" width="30" height="14" rx="2" ry="2" stroke="currentColor" fill="none" />
                <circle cx="24" cy="24" r="4" fill="currentColor" />
              </svg>
            </div>
          </article>
          <article class="card color-7">
            <div class="card-value">0</div>
            <div class="card-label">Bank</div>
            <button class="btn btn-text" style=" background-color: transparent; border: none; border-color: none;">More info →</button>
            <div class="illus" aria-hidden="true">
              <!-- Bank icon -->
              <svg viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg" focusable="false">
                <path d="M8 18l16-8 16 8v2H8z" fill="currentColor" opacity=".3" />
                <path d="M10 20h28v14H10zM8 36h32v2H8z" fill="currentColor" />
                <path d="M16 22v10M24 22v10M32 22v10" stroke="currentColor" stroke-width="2" />
              </svg>
            </div>
          </article>
        </div>
      </section>
@endsection
