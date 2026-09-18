// Header solid background on scroll
const header = document.getElementById('siteHeader');
const onScroll = () => header.classList.toggle('scrolled', window.scrollY > 10);
if (header) {
  onScroll();
  window.addEventListener('scroll', onScroll, { passive: true });
}

// Mobile menu toggle
const navToggle = document.getElementById('navToggle');
const navLinks = document.getElementById('navLinks');
if (navToggle && navLinks) {
  navToggle.addEventListener('click', () => {
    const open = navLinks.classList.toggle('open');
    navToggle.setAttribute('aria-expanded', String(open));
  });
  navLinks.querySelectorAll('a').forEach(link => {
    link.addEventListener('click', () => {
      navLinks.classList.remove('open');
      navToggle.setAttribute('aria-expanded', 'false');
    });
  });
}

// Scrollspy: highlight active nav link
const sections = ['home', 'activity', 'books', 'contact']
  .map(id => document.getElementById(id))
  .filter(Boolean);
const navByHash = {};
document.querySelectorAll('[data-nav]').forEach(a => {
  navByHash[a.getAttribute('href')] = a;
});
const spy = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      Object.values(navByHash).forEach(a => a.classList.remove('active'));
      const link = navByHash['#' + entry.target.id];
      if (link) link.classList.add('active');
    }
  });
}, { rootMargin: '-40% 0px -55% 0px', threshold: 0 });
sections.forEach(sec => spy.observe(sec));

// Book filter
const chips = document.querySelectorAll('.filter-chip');
let cards = document.querySelectorAll('.book-card');
const bookGrid = document.getElementById('bookGrid');
const bookSearch = document.getElementById('bookSearch');
const catalogCount = document.getElementById('catalogCount');
const params = new URLSearchParams(window.location.search);
const initialFilter = params.get('kategori');
const categoryLabels = {
  fiksi: 'Fiksi',
  'non-fiksi': 'Non-Fiksi',
  sains: 'Sains',
  anak: 'Anak',
  sejarah: 'Sejarah'
};

const createBookCard = book => {
  const card = document.createElement('article');
  card.className = 'book-card';
  card.dataset.category = book.category;
  card.style.setProperty('--spine', book.spine_color || 'var(--brass)');

  const status = document.createElement('span');
  status.className = `book-status ${book.status === 'borrowed' ? 'borrowed' : 'available'}`;
  status.textContent = book.status === 'borrowed' ? 'Dipinjam' : 'Tersedia';

  const title = document.createElement('h3');
  title.textContent = book.title;
  const author = document.createElement('p');
  author.className = 'book-author';
  author.textContent = book.author;
  const category = document.createElement('p');
  category.className = 'book-cat';
  category.textContent = categoryLabels[book.category] || book.category;

  card.append(status, title, author, category);
  return card;
};

const limitPreviewBooks = books => {
  if (!bookGrid?.classList.contains('home-book-grid')) return books;

  const categoryCounts = {};
  return books.filter(book => {
    categoryCounts[book.category] = (categoryCounts[book.category] || 0) + 1;
    return categoryCounts[book.category] <= 3;
  });
};

if (bookGrid?.classList.contains('home-book-grid')) {
  const previewCards = limitPreviewBooks([...cards]);
  cards.forEach(card => { if (!previewCards.includes(card)) card.remove(); });
  cards = bookGrid.querySelectorAll('.book-card');
}

const loadBooksFromDatabase = async () => {
  if (!bookGrid) return;

  try {
    const response = await fetch('/api/books');
    if (!response.ok) throw new Error('Katalog API tidak tersedia');
    const books = await response.json();
    bookGrid.replaceChildren(...limitPreviewBooks(books).map(createBookCard));
    cards = bookGrid.querySelectorAll('.book-card');
    updateBookList();
  } catch (error) {
    // Kartu statis tetap digunakan saat halaman dibuka langsung tanpa server.
  }
};

const updateBookList = () => {
  const activeChip = document.querySelector('.filter-chip.active');
  const filter = activeChip ? activeChip.dataset.filter : 'all';
  const query = bookSearch ? bookSearch.value.trim().toLowerCase() : '';
  let visibleCount = 0;

  cards.forEach(card => {
    const title = card.querySelector('h3')?.textContent.toLowerCase() || '';
    const author = card.querySelector('.book-author')?.textContent.toLowerCase() || '';
    const matchesFilter = filter === 'all' || card.dataset.category === filter;
    const matchesSearch = !query || title.includes(query) || author.includes(query);
    const show = matchesFilter && matchesSearch;
    card.hidden = !show;
    if (show) visibleCount += 1;
  });

  if (catalogCount) {
    catalogCount.textContent = `${visibleCount} buku ditemukan`;
  }
};

if (initialFilter) {
  const initialChip = document.querySelector(`[data-filter="${initialFilter}"]`);
  if (initialChip) {
    chips.forEach(chip => { chip.classList.remove('active'); chip.setAttribute('aria-selected', 'false'); });
    initialChip.classList.add('active');
    initialChip.setAttribute('aria-selected', 'true');
  }
}

chips.forEach(chip => {
  chip.addEventListener('click', () => {
    chips.forEach(c => { c.classList.remove('active'); c.setAttribute('aria-selected', 'false'); });
    chip.classList.add('active');
    chip.setAttribute('aria-selected', 'true');
    updateBookList();
  });
});

if (bookSearch) bookSearch.addEventListener('input', updateBookList);
updateBookList();
loadBooksFromDatabase();

// Approved comments are loaded through Laravel from the Supabase database.
const commentsList = document.getElementById('commentsList');

const loadComments = async () => {
  if (!commentsList) return;

  try {
    const response = await fetch('/api/comments');

    if (!response.ok) throw new Error('Could not load comments');
    const comments = await response.json();
    commentsList.replaceChildren();

    if (!comments.length) {
      commentsList.innerHTML = '<p class="comments-empty">Belum ada komentar yang ditampilkan.</p>';
      return;
    }

    comments.forEach(comment => {
      const article = document.createElement('article');
      article.className = 'comment-card';

      const name = document.createElement('h3');
      name.textContent = comment.name;
      const message = document.createElement('p');
      message.textContent = comment.message;
      article.append(name, message);
      commentsList.append(article);
    });
  } catch (error) {
    commentsList.innerHTML = '<p class="comments-empty">Komentar belum dapat dimuat.</p>';
  }
};

// Contact form is handled by Laravel and stored in the database.
const form = document.getElementById('contactForm');
const note = document.getElementById('formNote');
if (form) form.addEventListener('submit', async (e) => {
  e.preventDefault();
  if (!form.checkValidity()) {
    note.textContent = 'Mohon lengkapi nama, email, dan pesan terlebih dahulu.';
    return;
  }

  const submitButton = form.querySelector('button[type="submit"]');
  submitButton.disabled = true;
  submitButton.textContent = 'Mengirim...';
  note.textContent = '';

  try {
    const formData = new FormData(form);
    const response = await fetch(form.action, {
      method: 'POST',
      body: formData,
      headers: { Accept: 'application/json' }
    });

    if (!response.ok) throw new Error('Contact request failed');

    note.textContent = 'Pesan berhasil dikirim dan menunggu persetujuan admin.';
    form.reset();
    await loadComments();
  } catch (error) {
    note.textContent = 'Pesan belum terkirim. Silakan coba lagi.';
  } finally {
    submitButton.disabled = false;
    submitButton.textContent = 'Kirim Pesan';
  }
});

loadComments();
