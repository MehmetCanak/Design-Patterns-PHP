# `Singleton`

### Singleton, kendi türünde yalnızca bir nesnenin var olmasını sağlayan ve diğer tüm kodlar için ona tek bir erişim noktası sağlayan yaratıcı bir tasarım modelidir.

Singleton, global değişkenlerle neredeyse aynı artılara ve eksilere sahiptir. Çok kullanışlı olmalarına rağmen, kodunuzun modüler yapısını bozarlar.

Singleton'a bağlı olan bir sınıfı, Singleton'ı başka bir bağlama taşımadan başka bir bağlamda kullanamazsınız. Çoğu zaman, bu sınırlama birim testlerinin oluşturulması sırasında ortaya çıkar.


**Kullanım örnekleri:** 
- Pek çok geliştirici, Singleton modelini bir anti-kalıp olarak kabul eder. Bu yüzden PHP kodunda kullanımı azalmaktadır.

**Tanımlama:** 
- Singleton, aynı önbelleğe alınmış nesneyi döndüren statik bir oluşturma yöntemiyle tanınabilir.


## Kavramsal Örnek

Bu örnek, Singleton tasarım deseninin yapısını gösterir ve aşağıdaki sorulara odaklanır: 

- Hangi sınıflardan oluşur? 
- Bu sınıflar hangi rolleri oynuyor? 
- Modelin öğeleri nasıl ilişkilidir? 

Kalıbın yapısını öğrendikten sonra, gerçek dünyadan bir PHP kullanım senaryosuna dayanan ConceptualIndex.php örneği kavramanız daha kolay olacaktır.

## Real World Example (Gerçek Dünya Örneği)

> Singleton modeli , kodun yeniden kullanımını sınırlaması ve birim testini karmaşıklaştırmasıyla ünlüdür. 
> Ancak yine de bazı durumlarda çok kullanışlıdır. Özellikle, bazı paylaşılan kaynakları kontrol etmeniz gerektiğinde kullanışlıdır. 
> Örneğin, bir günlük dosyasına erişimi denetlemesi gereken genel bir günlük kaydı nesnesi. 
> Başka bir iyi örnek: paylaşılan bir çalışma zamanı yapılandırma depolaması.