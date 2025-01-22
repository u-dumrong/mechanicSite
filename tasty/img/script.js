const tocLinks = document.querySelectorAll('#toc a');

// เพิ่ม event listener สำหรับการคลิกที่ลิงก์สารบัญ
tocLinks.forEach(link => {
  link.addEventListener('click', (e) => {
    e.preventDefault();
    const targetId = link.getAttribute('href').substring(1);
    const targetSection = document.getElementById(targetId);

    // เลื่อนไปยังเป้าหมายแบบลื่นไหล
    targetSection.scrollIntoView({
      behavior: 'smooth',
      block: 'start',
    });
  });
});

// ทำให้ลิงก์สารบัญเน้นเมื่อเลื่อนผ่านส่วนของเนื้อหา
window.addEventListener('scroll', () => {
  let currentSection = '';
  document.querySelectorAll('section').forEach(section => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.offsetHeight;
    if (pageYOffset >= sectionTop - sectionHeight / 3) {
      currentSection = section.getAttribute('id');
    }
  });

  tocLinks.forEach(link => {
    link.classList.remove('active');
    if (link.getAttribute('href').substring(1) === currentSection) {
      link.classList.add('active');
    }
  });
});

function toggleSidebar() {
  const sidebar = document.getElementById('sidebar');
  sidebar.classList.toggle('hidden');
}
